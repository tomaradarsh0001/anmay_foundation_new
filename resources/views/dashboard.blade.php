@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="title-1">Welcome to Anmay Foundation Dashboard</h2>
    </div>
</div>

<div class="row m-t-30">
    <div class="col-md-12">
            <div class="card-body text-center">
                <!-- Animated Character -->
                <div class="character-container">
                    <div class="character">
                        <div class="head">
                            <div class="eye left"></div>
                            <div class="eye right"></div>
                            <div class="mouth"></div>
                        </div>
                        <div class="body">
                            <div class="arm left"></div>
                            <div class="arm right"></div>
                        </div>
                    </div>
                    <div class="speech-bubble">
                        Hi! 👋
                    </div>
                </div>
            </div>
        </div>
</div>

<style>
/* Container for centering */
.character-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 30px;
}

/* Speech bubble */
.speech-bubble {
    background: #4f46e5;
    color: white;
    padding: 10px 20px;
    border-radius: 20px;
    font-weight: bold;
    margin-bottom: 20px;
    animation: bounce 1.5s infinite;
}

/* Bounce animation for speech */
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

/* Character body */
.character {
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Head */
.head {
    width: 80px;
    height: 80px;
    background: #ffe0bd;
    border-radius: 50%;
    position: relative;
    margin-bottom: 10px;
}

/* Eyes */
.eye {
    width: 12px;
    height: 12px;
    background: black;
    border-radius: 50%;
    position: absolute;
    top: 25px;
}

.eye.left { left: 20px; }
.eye.right { right: 20px; }

/* Mouth */
.mouth {
    width: 30px;
    height: 10px;
    border-bottom: 3px solid black;
    border-radius: 50%;
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
}

/* Body */
.body {
    width: 20px;
    height: 50px;
    background: #4f46e5;
    position: relative;
    border-radius: 10px;
}

/* Arms */
.arm {
    width: 10px;
    height: 40px;
    background: #ffe0bd;
    position: absolute;
    top: 0;
    border-radius: 10px;
    transform-origin: top center;
}

/* Left arm waves */
.arm.left {
    left: -15px;
    animation: wave 2s infinite;
}

/* Right arm */
.arm.right {
    right: -15px;
}

/* Wave animation */
@keyframes wave {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(30deg); }
    50% { transform: rotate(0deg); }
    75% { transform: rotate(-30deg); }
}
</style>

@endsection