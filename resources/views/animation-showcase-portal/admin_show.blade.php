@extends('layout')
@section('title', 'Budget Hearing Questionnaire Submission for ' . $submission->institition)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar (Subnav) -->
            <div class="col-12 col-md-3 d-print-none py-5">
                <div class="card position-sticky" style="top: 100px;">
                    <div class="card-header">
                        <h6>Submission Information</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><strong>Institution:</strong> {{ $submission->institution }}</li>
                            <li><strong>Submittor Name:</strong> {{ $submission->submittor_name }}</li>
                            <li><strong>Submittor Email:</strong> {{ $submission->submittor_email }}</li>
                            <li><strong>Date Submitted:</strong> {{ $submission->created_at->format('m/d/Y') }}</li>

                        </ul>
                    </div>
                </div>

            </div>



            <!-- Main Content Area -->

            <div class="col-12 col-md-9">
                <div class="py-5">
                    <div class="container animation-submission">
                        <div class="mb-5">


                            <div class="row">
                                <div class="col-12">

                                    <div class="mb-4 card">
                                        <div class="card-header">
                                            <h6>{{ $submission->title }}</h6>
                                            <span class="badge bg-primary">{{ $submission->institution }}</span>
                                            <span class="badge bg-primary">{{ $submission->program }}</span>
                                        </div>
                                        <div class="card-body">
                                            <a href="{$submission->video_link}" target="_blank"
                                                class="btn btn-primary mb-3">View Animation on YouTube</a>


                                            {{-- generate the embed url using the video_link, by using the proper youtube or vimeo embed url for the video id --}}

                                            @php
                                                $video_id = '';
                                                if (strpos($submission->video_link, 'youtube') !== false) {
                                                    $video_id = explode('v=', $submission->video_link)[1];
                                                } elseif (strpos($submission->video_link, 'vimeo') !== false) {
                                                    $video_id = explode('vimeo.com/', $submission->video_link)[1];
                                                }

                                                $embed_url = '';
                                                if (strpos($submission->video_link, 'youtube') !== false) {
                                                    $embed_url = 'https://www.youtube.com/embed/' . $video_id;
                                                } elseif (strpos($submission->video_link, 'vimeo') !== false) {
                                                    $embed_url = 'https://player.vimeo.com/video/' . $video_id;
                                                }
                                            @endphp



                                            @if (strpos($submission->video_link, 'youtube') !== false)
                                                <iframe width="100%" height="315" src="{{ $embed_url }}"
                                                    frameborder="0" allowfullscreen></iframe>
                                            @elseif (strpos($submission->video_link, 'vimeo') !== false)
                                                <iframe src="{{ $embed_url }}" width="100%" height="315"
                                                    frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="mb-4 card">
                                        <div class="card-header">
                                            <h6>Submission Details</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 col">
                                                    <h6>Team Members</h6>
                                                    <p>{!! $submission->student_names !!}</p>

                                                    <h6>Team Bios</h6>
                                                    <p>{!! $submission->student_bios !!}</p>
                                                    

                                                    <h6>Submission Synopsis</h6>
                                                    <p>{{ $submission->synopsis }}</p>


                                                    <h6>Submission Description</h6>
                                                    <p>{{ $submission->description }}</p>

                                                    
                                                </div>
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
