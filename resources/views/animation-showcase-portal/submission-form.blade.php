@extends('layout')
@section('title', '2025 Big East Animation Showcase')
@section('content')
    <div class="hero text-center text-white py-5 animation-hero">
        <div class="container">
            <h1>2025 Big East <br>Animation Showcase
            </h1>
            <div class="memo">Submission Deadline: Feb 25th, 2025</div>


        </div>
        <img class="decorative" src="{{ url('/images/decorative.svg') }}" alt="">
    </div>
    <div class="form bg-light">
        <div class="container mt-5">
            <div class="row">
                <!-- Submission Guidelines Modal Trigger -->

                <!-- Submission Form -->
                <div class="col-md-9 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header card-header-main">
                            <h2 class="mb-0">Submit An Animation</h2>
                        </div>
                        <div class="card-body">
                            <div id="submission-form">
                                <form action="{{ route('animationShowcaseSubmission.store') }}"
                                    hx-post="{{ route('animationShowcaseSubmission.store') }}" hx-select=".alert"
                                    hx-swap="outerHTML" hx-target="#submission-form" method="POST">
                                    @csrf

                                    <!-- Institution Information -->
                                    <h6 class="mt-2 mb-3">Submittor Information</h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="submittor_name" class="form-label">Submittor Name</label>
                                            <input type="text" class="form-control" id="submittor_name"
                                                name="submittor_name" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="submittor_email" class="form-label">Submittor Email</label>
                                            <input type="email" class="form-control" id="submittor_email"
                                                name="submittor_email" required>
                                        </div>
                                    </div>

                                    <h6 class="mt-4 mb-3">Institution Information</h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="institution" class="form-label">Name of Institution</label>
                                            <select class="form-select" id="institution" name="institution" required>
                                                <option value="" selected disabled>Select an Institution</option>
                                                <option value="Butler University">Butler University</option>
                                                <option value="University of Connecticut">University of Connecticut</option>
                                                <option value="Creighton University">Creighton University</option>
                                                <option value="DePaul University">DePaul University</option>
                                                <option value="Georgetown University">Georgetown University</option>
                                                <option value="Marquette University">Marquette University</option>
                                                <option value="Providence College">Providence College</option>
                                                <option value="Seton Hall University">Seton Hall University</option>
                                                <option value="St. John's University">St. John's University</option>
                                                <option value="Villanova University">Villanova University</option>
                                                <option value="Xavier University">Xavier University</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="program" class="form-label">Relevant Department/Program</label>
                                            <input type="text" class="form-control" id="program" name="program"
                                                required>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="program_description" class="form-label">Program Description</label>
                                            <textarea class="form-control" id="program_description" name="program_description"
                                                rows="3" required></textarea>
                                        </div>

                                    </div>

                                    <h6 class="mt-4 mb-3 pt-3">Student Information</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="students-table">
                                            <thead>
                                                <tr>
                                                    <th>Student Name</th>
                                                    <th>Major</th>
                                                    <th>Graduation Year</th>
                                                    <th>Biography</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="students-body">
                                                <tr>
                                                    <td><input type="text" class="form-control" name="student_name[]" required></td>
                                                    <td><input type="text" class="form-control" name="student_major[]" required></td>
                                                    <td><input type="text" class="form-control" name="student_year[]" required></td>
                                                    <td><textarea class="form-control" name="student_bio[]" required></textarea></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-primary mt-2" id="add-student">Add Student</button>
                                    </div>
                                    

                                    <h6 class="mt-4 mb-3">Film Information</h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="title" class="form-label">Title of Work</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="video_link" class="form-label">YouTube/Vimeo Link</label>
                                            <input type="url" class="form-control" id="video_link" name="video_link"
                                                required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="synopsis" class="form-label">Short Synopsis (100-150 words)</label>
                                        <textarea class="form-control" id="synopsis" name="synopsis" rows="3" required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Detailed Description (if applicable
                                            for accessibility purposes)</label>
                                        <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                                    </div>

                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" id="accessibility"
                                            name="accessibility" required>
                                        <label class="form-check-label" for="accessibility">
                                            I acknowledge that this submission is subject to WCAG 2.1 - Level AA
                                            accessibility standards and may not be displayed if it cannot be made
                                            accessible.
                                        </label>
                                    </div>

                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-primary"
                                            hx-on:click="formatStudentData()">Submit Animation</button>
                                    </div>
                                </form>

                                <script>
                                    document.getElementById("add-student").addEventListener("click", function() {
                                        let tbody = document.getElementById("students-body");
                                        let newRow = document.createElement("tr");
                                        newRow.innerHTML = `
                                            <td><input type="text" class="form-control" name="student_name[]" required></td>
                                            <td><input type="text" class="form-control" name="student_major[]" required></td>
                                            <td><input type="text" class="form-control" name="student_year[]" required></td>
                                            <td><textarea class="form-control" name="student_bio[]" required></textarea></td>
                                            <td><button type="button" class="btn btn-danger remove-student">Remove</button></td>
                                        `;
                                        tbody.appendChild(newRow);
                                    });
                                    
                                    document.addEventListener("click", function(event) {
                                        if (event.target.classList.contains("remove-student")) {
                                            event.target.closest("tr").remove();
                                        }
                                    });
                                    </script>
                                    
            

                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-3">

                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <h3 class="mb-0">Submission Guidelines</h3>
                        </div>
                        <div class="card-body">
                            <p>Before submitting your animation, please review the guidelines below:</p>
                            <ul>
                                <li>Open to submissions from all Big East institutions.</li>
                                <li>Submissions can be individual or collaborative.</li>
                                <li>Only one submission per institution.</li>
                                <li>Films must be 1–5 minutes in length.</li>
                                <li>Must be original work; no unlicensed material.</li>
                                <li>Non-English films require English subtitles.</li>
                                <li>Submission deadline: February 25, 2025</li>
                            </ul>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#guidelinesModal">View Full Guidelines</button>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="mb-0">Accessibility Requirements</h3>
                        </div>
                        <div class="card-body">
                            <p>All submissions must comply with WCAG 2.1 - Level AA accessibility standards:</p>
                            <ul>
                                <li>Videos with audio must include accurate closed captions.
                                    <a href="https://www.w3.org/WAI/WCAG21/quickref/#captions-prerecorded"
                                        target="_blank">More
                                        info</a>
                                </li>
                                <li>Videos without audio must include a detailed text-based description.
                                    <a href="https://www.w3.org/WAI/WCAG21/quickref/#audio-only-and-video-only-prerecorded"
                                        target="_blank">More info</a>
                                </li>
                            </ul>
                            <p class="text-danger">Failure to meet these requirements may result in disqualification.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Submission Guidelines Modal -->
    <div class="modal fade" id="guidelinesModal" tabindex="-1" aria-labelledby="guidelinesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="guidelinesModalLabel">Submission Guidelines</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li><strong>Eligibility:</strong>
                            <ul>
                                <li>Open to submissions from all Big East institutions.</li>
                                <li>Submissions can be individual or collaborative.</li>
                                <li>Each Big East school should only submit a single animated film for the festival.</li>
                            </ul>
                        </li>
                        <li><strong>Film Requirements:</strong>
                            <ul>
                                <li>Genre: Any (2D, 3D, stop motion, etc.), PG-13 or below</li>
                                <li>Length: 1–5 minutes</li>
                                <li>Format: At least 1080p resolution, hosted via YouTube/Vimeo or similar</li>
                            </ul>
                        </li>
                        <li><strong>Originality:</strong> Must be original work; no unlicensed copyrighted material.
                        </li>
                        <li><strong>Language:</strong> Non-English films require English subtitles.</li>
                        <li><strong>Submission Process:</strong>
                            <ul>
                                <li>Submissions open February 10, 2025: <a
                                        href="https://poet.provost.uconn.edu/animation-showcase-submission">Submit
                                        Here</a></li>
                                <li>Include a short synopsis (100–150 words) and creator bio (50 words).</li>
                            </ul>
                        </li>
                        <li><strong>Timeline:</strong>
                            <ul>
                                <li>February 3: Outreach to institutions</li>
                                <li>February 10: Submission portal opens</li>
                                <li>February 25: Submission deadline</li>
                                <li>March 1: Files sent to Mohegan Sun</li>
                                <li>March 7-10: Screening during WBB tournament</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
    <style>
        .animation-hero {
            background: linear-gradient(0deg, rgba(1, 62, 205, 0.4), rgba(1, 62, 205, 0.5)), url("/images/animation-photo.png");
            background-position: center center;
            background-color: rgba(0, 0, 0, 0.2);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: visible;
            background-attachment: fixed;
        }

        .animation-hero .container {
            position: relative;
            z-index: 3;
            padding: 75px 0px;
            min-height: 400px;
        }

        .animation-hero h1,
        .animation-hero h2 {
            color: #fff;
            text-shadow: 0px 1px 6px rgba(0, 0, 0, 0.7);
            padding-bottom: 10px;
        }

        .memo {
            font-size: 20px;
            background-color: #000e2f;
            width: max-content;
            margin: 10px auto 20px auto;
            padding: 5px 15px;
        }

        .decorative {
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
            width: 100%;
        }

        .form {
            position: relative;
            top: 0px;
            padding: 40px 0px;
        }

        .form h2 {
            font-family: georgiapro, serif;
            color: #013ECD;
            font-weight: 500;
        }

        .card-header h2 {
            font-family: georgiapro, serif;
            font-weight: 500;
        }

        .card-header h3 {
            font-size: 22px;
        }

        .card {
            border: 0;
        }

        .card-header {
            background: #fff;
            border-bottom: 0px;
            padding-top: 20px;
            padding-bottom: 5px;
            border-top: 8px solid #03357a;
        }

        .card-header.card-header-main {
            border-top: 8px solid #013ECD;
        }

        .card-body {
            padding-top: 5px;
        }


        /* make it so the hero h1 and h2 fly in from the left with keyframes
                        make it so the form flies in from the right with keyframes */

        @keyframes fly-in-left {
            from {
                transform: translateX(-50%);
                opacity: 0;
            }

            to {
                transform: translateX(0%);
                opacity: 100%;
            }
        }

        @keyframes fly-in-right {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0%);
            }
        }

        @keyframes fly-in-down {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }

            to {
                transform: translateY(0%);
                opacity: 100%;
            }
        }

        @keyframes fly-in-up {
            from {
                transform: translateY(50%);
                opacity: 0;
            }

            to {
                transform: translateY(0%);
                opacity: 100%;
            }
        }

        .animation-hero h1,
        .animation-hero h2 {
            animation: fly-in-down 1s ease;
        }

        .card {
            animation: fly-in-up 1s ease;
        }
    </style>
@endsection
