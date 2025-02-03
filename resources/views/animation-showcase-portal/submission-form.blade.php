@extends('layout')
@section('title', '2025 Big East Animation Showcase')
@section('content')
<div class="hero text-center text-white py-5 animation-hero">
    <div class="container">
        <h1>2025 Big East <br>Animation Showcase
        </h1>
        <h2 style="font-style:normal">Submissions open Feb 10th, 2025</h2>
        <p class="memo">COMING SOON</p>

    </div>
    <img class="decorative" src="{{url('/images/decorative.svg')}}" alt="">
</div>
<div class="form bg-light">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Submission Guidelines</h5>
                    </div>
                    <div class="card-body">

                        <ul>
                            <li><strong>Eligibility:</strong>
                                <ul>
                                    <li>Open to submissions from all Big East institutions.</li>
                                    <li>Submissions can be individual or collaborative.</li>
                                    <li>Only one submission will be accepted from each Big East institution.</li>
                                </ul>
                            </li>
                            <li><strong>Film Requirements:</strong>
                                <ul>
                                    <li>Genre: Any genre (2D, 3D, stop motion, etc) but must align with a PG-13 rating or below</li>
                                    <li>Length: 1–5 minutes</li>
                                    <li>Format: At least 1080p resolution
                                        <ul>
                                            <li>Submitted via YouTube link or similar hosted services</li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><strong>Originality:</strong>
                                <ul>
                                    <li>Submissions must be original works; no copyrighted material unless properly licensed.</li>
                                </ul>
                            </li>
                            <li><strong>Language:</strong>
                                <ul>
                                    <li>Non-English films must include English subtitles.</li>
                                </ul>
                            </li>
                            <li><strong>Submission Process:</strong>
                                <ul>
                                    <li>Submissions will open on 10 February, 2025 at the following URL: <a href="https://poet.provost.uconn.edu/animation-showcase-submission">https://poet.provost.uconn.edu/animation-showcase-submission</a>
                                        <ul>
                                            <li>Short URL: <a href="https://s.uconn.edu/2025-animation-showcase-submission">s.uconn.edu/2025-animation-showcase-submission</a></li>
                                        </ul>
                                    </li>
                                    <li>Member institutions should select one video for submission.</li>
                                    <li>Include a short synopsis (100–150 words) and creator bio (50 words).</li>
                                </ul>
                            </li>
                            <li><strong>Submission Timeline:</strong>
                                <ul>
                                    <li>February 3: Outreach to Big East institutions with guidelines</li>
                                    <li>February 10: Submission portal opens at <a href="https://s.uconn.edu/2025-animation-showcase-submission">s.uconn.edu/2025-animation-showcase-submission</a></li>
                                    <li>February 25: Deadline for all submissions to be received</li>
                                    <li>March 1: Files are provided to Mohegan Sun arena</li>
                                    <li>March 7-10: Films are screened during WBB tournament</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Accessibility Requirements</h5>
                    </div>
                    <div class="card-body">
                        <p>All submissions must comply with WCAG 2.1 - Level AA accessibility standards:</p>
                        <ul>
                            <li>Videos with audio (including dialogue, narration, or relevant sound effects) must include accurate closed captions. Captions should reflect spoken content and meaningful sounds. 
                                <a href="https://www.w3.org/WAI/WCAG21/quickref/#captions-prerecorded">Ref: https://www.w3.org/WAI/WCAG21/quickref/#captions-prerecorded</a>
                            </li>
                            <li>Videos without audio must include a detailed text-based description of the video content. This description should provide enough detail for screen reader users to understand the visual elements and storyline. 
                                <a href="https://www.w3.org/WAI/WCAG21/quickref/#audio-only-and-video-only-prerecorded">Ref: https://www.w3.org/WAI/WCAG21/quickref/#audio-only-and-video-only-prerecorded</a>
                            </li>
                        </ul>
                        <p>Failure to meet these accessibility requirements may result in the submission being ineligible for inclusion.</p>
                    </div>
                </div>
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
        background-attachment: fixed;
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

        /* make it so the hero h1 and h2 fly in from the left with keyframes
    make it so the form flies in from the right with keyframes */

    @keyframes fly-in-left{
        from{
            transform:translateX(-100%);
        }
        to{
            transform:translateX(0%);
        }
    }

    @keyframes fly-in-right{
        from{
            transform:translateX(100%);
        }
        to{
            transform:translateX(0%);
        }
    }

    .animation-hero h1, .animation-hero h2{
        animation:fly-in-left 1s ease-out;
    }

    .form .col-md-6:nth-child(odd){
        animation:fly-in-right 1s ease-out;
    }

    .form .col-md-6:nth-child(even){
        animation:fly-in-left 1s ease-out;
    }


</style>
@endsection