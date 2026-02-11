<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->paginate(10);
        
        return view('testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('testimonials.create');
    }

    public function store(Request $request)
    {
        try {
            Log::info('Testimonial store method called', ['request_data' => $request->except('_token')]);
            
            $data = $request->validate([
                'text' => 'required|string',
                'name' => 'required|string|max:255',
                'profession' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:max_width=2500,max_height=2500',
            ]);
            
            Log::info('Validation passed', ['data' => $data]);

            if ($request->hasFile('image')) {
                Log::info('Image file detected', [
                    'file_name' => $request->file('image')->getClientOriginalName(),
                    'file_size' => $request->file('image')->getSize(),
                    'mime_type' => $request->file('image')->getMimeType()
                ]);
                
                $originalPath = $request->file('image')->store('testimonials', 'public');
                $data['image'] = $originalPath;
                
                Log::info('Image stored at path', ['path' => $originalPath]);
                
                // Resize image to 200x200 using GD
                $imagePath = storage_path('app/public/' . $originalPath);
                
                Log::info('Attempting to resize image', ['full_path' => $imagePath]);
                
                if (file_exists($imagePath)) {
                    $this->resizeImage($imagePath, 200, 200);
                    Log::info('Image resized successfully using GD');
                    
                    // Log image info after resize
                    Log::info('Resized image info', [
                        'size' => filesize($imagePath),
                        'dimensions' => getimagesize($imagePath)
                    ]);
                } else {
                    Log::error('Image file not found at path', ['path' => $imagePath]);
                }
            } else {
                Log::info('No image file provided');
            }

            // Create testimonial
            $testimonial = Testimonial::create($data);
            Log::info('Testimonial created successfully', ['testimonial_id' => $testimonial->id]);

            return redirect()->route('testimonials.index')->with('success', 'Testimonial added!');
            
        } catch (\Exception $e) {
            Log::error('Error in testimonial store method', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withInput()->with('error', 'Error adding testimonial: ' . $e->getMessage());
        }
    }

    /**
     * Resize image using GD library
     */
    private function resizeImage($path, $width, $height)
    {
        // Get image info
        $info = getimagesize($path);
        $mime = $info['mime'];
        
        // Create image based on mime type
        switch ($mime) {
            case 'image/jpeg':
                $sourceImage = imagecreatefromjpeg($path);
                break;
            case 'image/png':
                $sourceImage = imagecreatefrompng($path);
                break;
            case 'image/gif':
                $sourceImage = imagecreatefromgif($path);
                break;
            default:
                throw new \Exception('Unsupported image type: ' . $mime);
        }
        
        // Get original dimensions
        $originalWidth = imagesx($sourceImage);
        $originalHeight = imagesy($sourceImage);
        
        // Create new image
        $newImage = imagecreatetruecolor($width, $height);
        
        // Handle transparency for PNG and GIF
        if ($mime == 'image/png' || $mime == 'image/gif') {
            imagecolortransparent($newImage, imagecolorallocatealpha($newImage, 0, 0, 0, 127));
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            
            // For GIF, preserve transparency
            if ($mime == 'image/gif') {
                $transparentIndex = imagecolortransparent($sourceImage);
                if ($transparentIndex >= 0) {
                    $transparentColor = imagecolorsforindex($sourceImage, $transparentIndex);
                    $transparentIndex = imagecolorallocate($newImage, $transparentColor['red'], $transparentColor['green'], $transparentColor['blue']);
                    imagefill($newImage, 0, 0, $transparentIndex);
                    imagecolortransparent($newImage, $transparentIndex);
                }
            }
        } else {
            // For JPEG, add white background
            $white = imagecolorallocate($newImage, 255, 255, 255);
            imagefill($newImage, 0, 0, $white);
        }
        
        // Calculate aspect ratio and resize
        $srcX = 0;
        $srcY = 0;
        $srcWidth = $originalWidth;
        $srcHeight = $originalHeight;
        
        // Calculate aspect ratios
        $srcRatio = $originalWidth / $originalHeight;
        $dstRatio = $width / $height;
        
        if ($srcRatio > $dstRatio) {
            // Source is wider - crop width
            $newWidth = $originalHeight * $dstRatio;
            $srcX = ($originalWidth - $newWidth) / 2;
            $srcWidth = $newWidth;
        } else {
            // Source is taller - crop height
            $newHeight = $originalWidth / $dstRatio;
            $srcY = ($originalHeight - $newHeight) / 2;
            $srcHeight = $newHeight;
        }
        
        // Resize and crop to fit
        imagecopyresampled(
            $newImage, $sourceImage,
            0, 0,
            $srcX, $srcY,
            $width, $height,
            $srcWidth, $srcHeight
        );
        
        // Save based on file type
        switch ($mime) {
            case 'image/jpeg':
                imagejpeg($newImage, $path, 90);
                break;
            case 'image/png':
                imagepng($newImage, $path, 9);
                break;
            case 'image/gif':
                imagegif($newImage, $path);
                break;
        }
        
        // Free memory
        imagedestroy($sourceImage);
        imagedestroy($newImage);
    }

    public function edit(Testimonial $testimonial)
    {
        return view('testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        try {
            $data = $request->validate([
                'text' => 'required|string',
                'name' => 'required|string|max:255',
                'profession' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:max_width=400,max_height=400',
            ]);

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                    Storage::disk('public')->delete($testimonial->image);
                    Log::info('Old image deleted', ['path' => $testimonial->image]);
                }
                
                $originalPath = $request->file('image')->store('testimonials', 'public');
                $data['image'] = $originalPath;
                
                // Resize image to 200x200
                $imagePath = storage_path('app/public/' . $originalPath);
                
                if (file_exists($imagePath)) {
                    $this->resizeImage($imagePath, 200, 200);
                    Log::info('Image resized successfully during update', ['path' => $originalPath]);
                }
            } else {
                // Keep existing image if no new image uploaded
                $data['image'] = $testimonial->image;
            }

            $testimonial->update($data);
            Log::info('Testimonial updated successfully', ['testimonial_id' => $testimonial->id]);

            return redirect()->route('testimonials.index')->with('success', 'Updated successfully!');
            
        } catch (\Exception $e) {
            Log::error('Error in testimonial update method', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withInput()->with('error', 'Error updating testimonial: ' . $e->getMessage());
        }
    }

    public function destroy(Testimonial $testimonial)
    {
        try {
            // Delete image if exists
            if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                Storage::disk('public')->delete($testimonial->image);
                Log::info('Image deleted during testimonial removal', ['path' => $testimonial->image]);
            }
            
            $testimonial->delete();
            Log::info('Testimonial deleted', ['testimonial_id' => $testimonial->id]);
            
            return back()->with('success', 'Deleted successfully!');
            
        } catch (\Exception $e) {
            Log::error('Error in testimonial destroy method', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Error deleting testimonial: ' . $e->getMessage());
        }
    }
}