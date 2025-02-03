@extends('layout')
@section('title', 'Contact')
@section('content')
<div class="hero text-center text-white py-5 animation-hero">
    <div class="container">
        <h1>2025 Big East <br>Animation Showcase
        </h1>
        <h2 style="font-style:normal">This could be a subtitle</h2>
        <p class="memo">COMING SOON</p>

    </div>
    <img class="decorative" src="{{url('/images/decorative.svg')}}" alt="">
</div>
<div class="form">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
            <h2>Submission Form Fields</h2>
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="file">Upload File</label>
                    <input type="file" class="form-control-file" id="file" name="file" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>
<style>
    .animation-hero{
        background:linear-gradient(0deg, rgba(1, 62, 205, 0.4), rgba(1, 62, 205, 0.5)), url("/images/animation-photo.png");
        background-position:center center;
        background-color:rgba(0,0,0,0.2);
        position:relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        overflow:visible;
    }
    .animation-hero .container{
        position:relative;
        z-index:3;
        padding:75px 0px;
        min-height:400px;
    }
    .animation-hero h1, .animation-hero h2{
        color:#fff;
        text-shadow:0px 1px 6px rgba(0,0,0,0.7);
        padding-bottom:10px;
    }
    .memo{
        font-size:20px;
        background-color:#000e2f;
        width:max-content;
        margin:10px auto 20px auto;
        padding:5px 15px;
    }

    .decorative{
        user-drag: none;
        -webkit-user-drag: none;
        user-select: none;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%) translateY(40%);
        width:100%;
    }

    .form{
        position:relative;
        top:0px;
        padding:80px 0px;
    }

    .form h2{
        font-family: georgiapro, serif;
        color: #013ECD;
        font-weight:500;
        text-align:center;
    }

</style>
@endsection