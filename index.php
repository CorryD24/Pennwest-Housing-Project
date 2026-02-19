<?php
$title = "Home";
require_once '../view/header.php'; // This requires the header
?>

<!-- Bootstrap Carousel -->
<div id="homepageCarousel" class="carousel slide" data-bs-ride="carousel">


    <div class="carousel-indicators">
        <button type="button" data-bs-target="#homepageCarousel" data-bs-slide-to="0" class="active" aria-current="true"
            aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#homepageCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#homepageCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="../img/slideshow/Clarion.jpg" class="d-block w-100" alt="Clarion">
        </div>
        <div class="carousel-item">
            <img src="../img/slideshow/Boro.jpg" class="d-block w-100" alt="Edinboro">
        </div>
        <div class="carousel-item">
            <img src="../img/slideshow/Cal.jpg" class="d-block w-100" alt="California">
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#homepageCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#homepageCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Room Layout Section -->
<h2 style="text-align:center; margin-top: 40px;">View Room Layouts</h2>

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text font16" for="campusSelect"">Select Campus:</label>
                </div>
                <select class=" form-select font16" id="campusSelect" style="padding: 4px 8px; margin-right: 20px;">
                        <option value=""></option>
                        <option value="california">California</option>
                        <option value="edinboro">Edinboro</option>
                        <option value="clarion">Clarion</option>
                        </select>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font16" for="buildingSelect">Select
                            Building:</label>
                    </div>
                    <select class="form-select font16" id="buildingSelect" disabled
                        style=" padding: 4px 8px; margin-right: 20px;">
                        <option value=""></option>
                    </select>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font16" for="roomSelect">Select Room Type:</label>
                    </div>
                    <select class="form-select font16" id="roomSelect" disabled style="padding: 4px 8px;">
                        <option value=""></option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div style="text-align:center;">
        <img id="roomImage" src="" alt="Room Layout" style="display:none; margin-top:30px; max-width:600px; width:80%;">
        <div id="roomDesc" style="display:none; margin:20px auto; max-width:600px; font-size:16px; text-align:left;">
        </div>
    </div>

    <!-- Room Layout Script -->
    <script>
        const roomLayouts = {
            california: {
                "Residence Halls": {
                    "2 Person Semi Suite (1 bath)": {
                        img: "../img/slideshow/california-2-person-semi-suite-1-bath.png",
                        desc: `
                    <ul>
                        <li><strong>Entryway (vinyl)</strong> - approximately 9' x 4'8"</li>
                        <li><strong>Bedroom area (carpeted)</strong> - approximately 16' x 16'18"</li>
                        <li><strong>Closets (vinyl)</strong> - approximately 4'5" x 2'</li>
                        <li><strong>Sink area (vinyl)</strong> - approximately 6' x 3'</li>
                        <li><strong>Toilet/shower area (vinyl)</strong> - approximately 6'8" x 36' (accessible rooms approx. 6'3" x 6'3")</li>
                    </ul>
                `
                    },
                    "2 Single Bedroom Suite (1 bath)": {
                        img: "../img/slideshow/residencehall-2-single-bedroom-suite-1-bath.png",
                        desc: `
                    <ul>
                        <li><strong>Entryway (vinyl)</strong> - approximately 9'2" x 8'2"</li>
                        <li><strong>Entryway Closet (vinyl)</strong> - approximately 5'3" x 1'10"</li>
                        <li><strong>Common Living Area (carpeted)</strong> - approximately 20'10" x 12'7"</li>
                        <li><strong>Bedroom areas (carpeted)</strong> - approximately 10' x 13'8"</li>
                        <li><strong>Bedroom Closets (vinyl)</strong> - approximately 4' x 2'</li>
                    </ul>
                `
                    },
                    "4 Single Bedroom Suite (2 Bath)": {
                        img: "../img/slideshow/residencehall-4-single-bedroom-suite-2-bath.png",
                        desc: `
                    <ul>
                        <li><strong>Entryway (vinyl)</strong> - approximately 10' x 5' (counter and cabinets in this area)</li>
                        <li><strong>Entryway Closet (vinyl)</strong> - approximately 7'8" x 2'</li>
                        <li><strong>Common Living Area (carpeted)</strong> - approximately 10' x 16'8" or 11'8" x 10'7"</li>
                        <li><strong>Bedroom Closets (vinyl)</strong> - approximately 4' x 2'</li>
                   </ul> `
                    },
                    "2 Single Bedroom Suite (2 Bath)": {
                        img: "../img/slideshow/residencehall-2-single-bedroom-suite-2-bath.png",
                        desc: `
                    <ul>
                        <li><strong>Entryway (vinyl)</strong> - approximately 8'7" x 10'4" (counter and cabinets in this area)</li>
                        <li><strong>Entryway Closet (vinyl)</strong> - approximately 5'3" x 1'10"</li>
                        <li><strong>Common living area (carpeted)</strong> - approximately 14'11" x 18'</li>
                        <li><strong>Bedroom area (carpeted)</strong> - approximately 13'8" x 15'7"</li>
                        <li><strong>Bedroom closets (vinyl)</strong> - approximately 4'5" x 2'</li>
                        <li><strong>Sink area (vinyl)</strong> - approximately 6' x 3'</li>
                        <li><strong>Toilet/shower area (vinyl)</strong> - approximately 6'8" x 36' (accessible rooms approximately 6'3" x 6'3")</li>
                    </ul> `
                    },
                    "2 Single Bedroom Semi-Suite (1 Bath)": {
                        img: "../img/slideshow/residencehall-2-single-bedroom-semi-suite-1-bath.png",
                        desc: `
                    <ul>
                        <li><strong><i>Guesman Hall Only - Limited Availability</i></strong></li>
                        <li><strong>Entryway (vinyl)</strong> - approximately 9' x 4'8"</li>
                        <li><strong>Bedroom area (carpeted)</strong> - approximately 16' x 16'18"</li>
                        <li><strong>Closets (vinyl)</strong> - approximately 4'5" x 2'</li>
                        <li><strong>Sink area (vinyl)</strong> - approximately 6' x 3'</li>
                        <li><strong>Toilet/shower area (vinyl)</strong> - approximately 6'8" x 36' (accessible rooms approximately 6'3" x 6'3")</li>
                    </ul> `
                    }
                },
                "Vulcan Village": {
                    "2 Bedroom (2 Bath)": {
                        img: "../img/slideshow/vulcan-village-2-bedroom-2-bath.png",
                        desc: `
                    <ul>
                        <li><strong>Dresser</strong> - 36" x 30" x 42"</li>
                        <li><strong>Bed</strong> - 79" x 52" x 6.5"</li>
                        <li><strong>Desk</strong> - 30" x 24" x 48"</li>
                        <li><strong>Living Room Chair</strong> - 18" x 24"</li>
                        <li><strong>Couch</strong> - 72" x 36" x 30"</li>
                        <li><strong>Coffee Table</strong> - 12" x 24" x 18"</li>
                        <li><strong>End Table</strong> - 24" x 24" x 24"</li>
                        <li><strong>Bedroom Window</strong> - 58" x 34.5"</li>
                        <li><strong>Living Room Window</strong> - 58" x 70.5"</li>
                        <li><strong>Shower Rod</strong> - 51"</li>
                    </ul> `
                    },
                    "4 Bedroom (4 Bath)": {
                        img: "../img/slideshow/vulcan-village-4-bedroom-4-bath.png",
                        desc: `
                <ul>
                    <li><strong>Dresser</strong> - 36" x 30" x 42"</li>
                    <li><strong>Bed</strong> - 79" x 52" x 6.5"</li>
                    <li><strong>Desk</strong> - 30" x 24" x 48">/li>
                    <li><strong>Living Room Chair</strong> - 18" x 24"</li>
                    <li><strong>Couch</strong> - 72" x 36" x 30"</li>
                    <li><strong>Coffee Table</strong> - 12" x 24" x 18"</li>
                    <li><strong>End Table</strong> - 24" x 24" x 24"</li>
                    <li><strong>Dining Room Table</strong> - 48" x 36" x 30"</li>
                    <li><strong>Bedroom Window</strong> - 58" x 34.5"</li>
                    <li><strong>Living Room Window</strong> - 58" x 70.5"</li>
                    <li><strong>Shower Rod</strong> - 51"</li>
                </ul> `
                    },
                    "Super 2 (2 Bed 2 Bath)": {
                        img: "../img/slideshow/vulcan-village-super-2-2-bed-2-bath.png",
                        desc: `
                <ul>
                    <li><strong>Dresser</strong> - 36" x 30" x 42"</li>
                    <li><strong>Bed</strong> - 79" x 52" x 6.5"</li>
                    <li><strong>Desk</strong> - 30" x 24" x 48"</li>
                    <li><strong>Living Room Chair</strong> - 18" x 24"</li>
                    <li><strong>Couch</strong> - 72" x 36" x 30"</li>
                    <li><strong>Coffee Table</strong> - 12" x 24" x 18"</li>
                    <li><strong>End Table</strong> - 24" x 24" 24"</li>
                    <li><strong>Bedroom Window</strong> - 58" x 34.5"</li>
                    <li><strong>Living Room Window</strong> - 58" x 70.5"</li>
                    <li><strong>Shower Rod</strong> - 51"</li>
                </ul> `
                    }
                }
            },
            edinboro: {
                "The Highlands": {
                    "Studio Single (1 Bath)": {
                        img: "../img/slideshow/studio-single-1-bath.jpeg",
                        desc: `
                <ul>
                    <li><strong>1 Person Occupancy</strong></li>
                    <li><strong>Furniture Included:</strong> 1 Full Bed, 1 Dresser Unit, 1 Desk, 1 Desk Chair, and 1 Bookshelf</li>
                    <li><strong>Furniture Varied:</strong> 1 Wardrobe, 1 Table with Chairs, 1 Entertainment Stand, 1 Sofa Chair</li>
                    <li><strong>1 Bathroom Space:</strong> Includes Shower (with or without tub), Toilet, Sink</li>
                    <li><strong>Dimensions:</strong></li>
                    <li><strong>Room:</strong> Length (14'6") | Width (10'3") | Height (8'10")</li>
                    <li><strong>Window:</strong> Width (3'1") | Height (4'8")</li>
                    <li><strong>Closet:</strong> Width (4') | Height (6'8") | Depth (2'2")</li>
                </ul> `
                    },
                    "4 Single Bedroom Semi-Suite (1 Bath)": {
                        img: "../img/slideshow/4-single-bedroom-semi-suite-1-bath.jpeg",
                        desc: `
                <ul>
                    <li><strong>4 Person Occupancy, 1 Person Per Bedroom</strong></li>
                    <li><strong>Furniture Included Per Person:</strong> 1 Full Bed, 1 Dresser Unit, 1 Desk, 1 Desk Chair, and 1 Bookshelf</li>
                    <li><strong>1 Shower Space</strong></li>
                    <li><strong>1 Toilet Space</strong></li>
                    <li><strong>2 Vanity Sinks:</strong> located outside of the traditional bathroom are for easier access</li>
                    <li><strong>Dimensions:</strong></li>
                    <li><strong>Room:</strong> Length (10'2") | Width (8'8") | Height (8'10")</li>
                    <li><strong>Window:</strong> Width (3'1") | Height (4'8")</li>
                    <li><strong>Closet:</strong> Width (4') | Height (6'8") | Depth (2'2")</li>
                </ul> `
                    },
                    "2 Double Bedroom Semi-Suite (1 Bath)": {
                        img: "../img/slideshow/2-double-bedroom-semi-suite-1-bath.jpeg",
                        desc: `
                <ul>
                    <li><strong>4 Person Occupancy, 2 People Per Bedroom</strong></li>
                    <li><strong>Furniture Included Per Person:</strong> 1 Twin XL Bed, 1 Dresser Unit, 1 Desk, 1 Desk Chair, and 1 Bookshelf</li>
                    <li><strong>1 Shower Space</strong></li>
                    <li><strong>1 Toilet Space</strong></li>
                    <li><strong>2 Vanity Sinks:</strong> located outside of the traditional bathroom are for easier access</li>
                    <li><strong>Dimensions:</strong></li>
                    <li><strong>Room:</strong> Length (10'8") | Width (14') | Height (8'10")</li>
                    <li><strong>Window:</strong> Width (3'1") | Height (4'8")</li>
                    <li><strong>Closet:</strong> Width (4') | Height (6'8") | Depth (2'2")</li>
                </ul> `
                    },
                    "4 Single Bedroom Suite (2 Bath)": {
                        img: "../img/slideshow/4-single-bedroom-suite-2-bath.jpeg",
                        desc: `
                <ul>
                    <li><strong>4 Person Occupancy, 1 Per Bedroom</strong></li>
                    <li><strong>Bedroom Furniture Included Per Person:</strong> 1 Full Bed, 1 Dresser Unit, 1 Desk, 1 Desk Chair, and 1 Bookshelf</li>
                    <li>Shared Common Area</li>
                    <li><strong>Common Area Furniture Included:</strong> 1 Couch, 1 Loveseat, 1 Entertainment Stand, 1 Coffee Table, 1 Side Table</li>
                    <li><strong>2 Bathroom Spaces:</strong> Includes Shower (with our without tub), Toilet</li>
                    <li><strong>2 Vanity Sinks Per Bathroom Area:</strong> located outside of the traditional bathroom are for easier access</li>
                    <li><strong>Dimensions:</strong></li>
                    <li><strong>Room:</strong> Length (10'10") | Width (10'2") | Height (8'10")</li>
                    <li><strong>Window:</strong> Width (3'1") | Height (4'1")</li>
                    <li><strong>Closet:</strong> Width (4') | Height (6'8") | Depth (2'2")</li>
                </ul> `
                    },
                    "2 Double Bedroom Suite (2 Bath)": {
                        img: "../img/slideshow/2-double-bedroom-suite-2-bath.jpeg",
                        desc: `
                <ul>
                    <li><strong>4 Person Occupancy, 2 People Per Bedroom</strong></li>
                    <li><strong>Bedroom Furniture Included Per Person:</strong> 1 Twin XL Bed, 1 Dresser Unit, 1 Desk, 1 Desk Chair, and 1 Bookshelf</li>
                    <li>Shared Common Area</li>
                    <li><strong>Common Area Furniture Included:</strong> 2 Loveseats, 1 Entertainment Stand, 1 Coffee Table, 1 Side Table</li>
                    <li><strong>2 Ensuite Bathroom Spaces:</strong> Includes Shower (with or without bathtub), Toilet</li>
                    <li><strong>2 Vanity Sinks Per Bathroom Area:</strong> located outside of the traditional bathroom are for easier access</li>
                    <li><strong>Dimensions:</strong></li>
                    <li><strong>Room:</strong> Length (14'8") | Width (9'10") | Height (8'10")</li>
                    <li><strong>Window:</strong> Width (3'1") | Height (4'8")</li>
                    <li><strong>Closet:</strong> Width (4') | Height (4'8") | Depth (2'2")</li>
                </ul> `
                    },
                    "2 Single Bedroom Suite (2 Bath)": {
                        img: "../img/slideshow/2-single-bedroom-suite-2-bath.jpeg",
                        desc: `
                <ul>
                    <li><strong><i>This is a limited room type, currently only available in Highlands 7. This room type is not available for first-year students</i></strong></li>
                    <li><strong>2 Person Occupancy, 1 Person Per Bedroom</strong></li>
                    <li><strong>Bedroom Furniture Included Per Person:</strong> 1 Twin XL Bed, 1 Dresser Unit, 1 Desk, 1 Desk Chair, 1 Bookshelf</li>
                    <li>Shared Common Area</li>
                    <li><strong>Common Area Furniture Included:</strong> 2 Loveseats, 1 Entertainment Stand, 1 Coffee Table, 1 Side Table</li>
                    <li><strong>2 Ensuite Bathroom Spaces:</strong> Includes Shower (with or without bathtub), Toilet</li>
                    <li><strong>2 Vanity Sinks Per Bathroom Area:</strong> located outside of the traditional outside of the traditional bathroom for easier access</li>
                </ul> `
                    }

                }
            },
            clarion: {
                "Suites On Main": {
                    "2 Person Semi-Suite (1 Bath)": {
                        img: "../img/slideshow/main-2-person-semi-suite-1-bath.png",
                        desc: `
                <ul>
                    <li>1 bedroom and bathroom for 2 students</li>
                    <li>Twin-size Beds</li>
                    <li>Central air and heat</li>
                    <li>Semi-suites do not have a full living room</li>
                    <li><strong>Dimensions:</strong></li>
                    <li><strong>Entrance Way:</strong> Width (7 ft.) | Length (3 ft.)</li>
                    <li><strong>Bedroom:</strong> Width (12 ft.) | Length (13 ft.)</li>
                    <li><strong>Window:</strong> Width (58 in.) | Length (55 in.)</li>
                    <li><strong>Closet:</strong> Width (50 in.) | Depth (28 in.) | (Per Student)</li>
                </ul> `
                    },
                    "2 Single Bedroom Semi-Suite (1 Bath)": {
                        img: "../img/slideshow/main-2-single-bedroom-semi-suite-1-bath.png",
                        desc: `
                <ul>
                    <li>2 bedrooms - each holding 1 student</li>
                    <li>Twin-size beds</li>
                    <li>1 shared bathroom</li>
                    <li>Dining table and 2 chairs in shared living space</li>
                    <li>Central air and heat</li>
                    <li><strong>Dimensions:</strong></li>
                    <li><strong>Common Space:</strong> Width (14 ft.) | Length (10 ft.)</li>
                    <li><strong>Bedroom:</strong> Width (9 ft.) | Length (14.5 ft.)</li>
                    <li><strong>Window:</strong> Width (38 in.) | Length (54 in.)</li>
                    <li><strong>Closet:</strong> Width (40 in.) | Depth (28 in.)</li>
                </ul> `
                    }

                },
                "Hilltop Suites": {
                    "2 Double Bedrooms Suite (2 Bath)": {
                        img: "../img/slideshow/hilltop-2-double-bedrooms-suite-2-bath.png",
                        desc: `
                <ul>
                    <li>2 shared bedrooms - each housing 2 students</li>
                    <li>Twin-size beds</li>
                    <li>1 shared bathroom per bedroom</li>
                    <li>Fully furnished living room area (couch, armed chair, end table, and coffee table)</li>
                    <li>Central air and heat</li>
                    <li><strong>Dimensions:</strong></li>
                    <li><strong>Living Room:</strong> Width (10 ft. 6 in.) | Length (15ft.)</li>
                    <li><strong>Bedroom:</strong> Width (14 ft. 6 in.) | Length (15 ft.)</li>
                    <li><strong>Living Room Window (1st floor):</strong> Width (38 in.) | Height (64 in.)</li>
                    <li><strong>Living Room Window (2nd, 3rd, and 4th floor):</strong> Width (38 in.) | Height (48 in.)</li>
                    <li><strong>Bedroom Window:</strong> Width (64 in.) | Height (64 in.)</li>
                    <li><strong>Living Room Closet:</strong> Width (38 in.) | Depth (24 in.) | Height (to the ceiling)</li>
                    <li><strong>Bedroom Closet:</strong> Width (48 in.) | Depth (24 in.) | Height (72 in.)</li>
                </ul> `
                    },
                    "2 Person Suite (1 Bath)": {
                        img: "../img/slideshow/hilltop-2-person-suite-1-bath.png",
                        desc: `
                <ul>
                    <li>1 shared bedroom - housing 2 students</li>
                    <li>Twin-size beds</li>
                    <li>1 shared bathroom</li>
                    <li>Fully furnished living room area (couch, armed chair, end table, and coffee table)</li>
                    <li>Central air and heat</li>
                    <li><strong>Dimensions:</strong></li>
                    <li><strong>Living Room:</strong> Width (10 ft. 6 in.) | Length (15 ft.)</li>
                    <li><strong>Bedroom:</strong> Width (14 ft. 6 in.) | Length (15 ft.)</li>
                    <li><strong>Living Room Window (1st floor):</strong> Width (38 in.) | Height (64 in.)</li>
                    <li><strong>Living Room Window (2nd, 3rd, and 4th floor):</strong> Width (38 in.) | Height (48 in.)</li>
                    <li><strong>Bedroom Window:</strong> Width (64 in.) | Height (64 in.)</li>
                    <li><strong>Living Room Closet</strong> Width (38 in.) | Depth (24 in.) | Height (to the ceiling)</li>
                    <li><strong>Bedroom Closet:</strong> Width (48 in.) | Depth (24 in.) | Height (72 in.)</li>
                </ul> `
                    },
                    "2 Single Bedrooms Suite (2 Bath)": {
                        img: "../img/slideshow/hilltop-2-single-bedrooms-suite-2-bath.png",
                        desc: `
                <ul>
                    <li><strong><i>This is a limited room type currently only available for FALL 2024-SPRING 2025</i></strong></li>
                    <li>2 person occupancy, 1 person per bedroom</li>
                    <li>Twin-size beds</li>
                    <li>1 bathroom per bedroom</li>
                    <li>Fully furnished living room area (couch, armed chair, end table, and coffee table)</li>
                    <li>Central air and Heat</li>
                    <li><strong>Dimensions:</strong></li>
                    <li><strong>Living Room:</strong> Width (10 ft. 6 in.) | Length (15 ft.)</li>
                    <li><strong>Bedroom:</strong> Width (14 ft. 6 in.) | Length (15 ft.)</li>
                    <li><strong>Living Room Window (1st floor):</strong> Width (38 in.) | Height (64 in.)</li>
                    <li><strong>Living Room Window (2nd, 3rd, and 4th floor):</strong> Width (38 in.) | Height (48 in.)</li>
                    <li><strong>Bedroom Window:</strong> Width (64 in.) | Height (64 in.)</li>
                    <li><strong>Living Room Closet:</strong> Width (38 in.) | Depth (24 in.) | Height (to the ceiling)</li>
                    <li><strong>Bedroom Closet:</strong> Width (48 in.) | Depth (24 in.) | Height (72 in.)</li>
                </ul> `
                    }
                },
                "Reinhard Villages": {
                    "4 Bedroom (4 Bath)": {
                        img: "../img/slideshow/Reinhard-4-bedroom-4-bath.png",
                        desc: `
                <ul>
                    <li>Private bedrooms</li>
                    <li>Full-size beds</li>
                    <li>Private or shared bathrooms - depending on style</li>
                    <li>Washer and dryer in each apartment</li>
                    <li>Full kitchen (microwave, refrigerator, stove, dishwasher, garbage disposal, and dining table with chairs)</li>
                    <li>Fully furnished living room (couch, table, chair, TV stand, and end table)</li>
                    <li>Central air and heat</li>
                    <li><strong>Dimensions:</strong></li>
                    <li><strong>Living Room Window:</strong> Width (78 in.) | Height (59 in.)</li>
                    <li><strong>Bedroom Window:</strong> Width (38 in.) | Height (58 in.)</li>
                    <li><strong>Closet:</strong> Width (55 in.) | Depth (27 in.)</li>
                </ul> `
                    },
                    "2 Bedroom (2 Bath)": {
                        img: "../img/slideshow/reinhard-2-bedroom-2-bath.png",
                        desc: `
                <ul>
                    <li>Private bedrooms</li>
                    <li>Full-size beds</li>
                    <li>Private or shared bathrooms - depending on style</li>
                    <li>Washer and dryer in each apartment</li>
                    <li>Full kitchen (microwave, refrigerator, stove, dishwasher, garbage disposal, and dining table with chairs)</li>
                    <li>Fully furnished living room (couch, table, chair, TV stand, and end table)</li>
                    <li>Central air and heat</li>
                    <li><strong>Dimensions:</strong></li>
                    <li><strong>Living Room Window:</strong> Width (78 in.) | Height (59 in.)</li>
                    <li><strong>Bedroom Window:</strong> Width (38 in.) | Height (58 in.)</li>
                    <li><strong>Closet:</strong> Width (55 in.) | Depth (27 in.)</li>
                </ul> `
                    },
                    "4 Bedroom Flat (2 Bath)": {
                        img: "../img/slideshow/reinhard-4-bedroom-flat-2-bath.png",
                        desc: `
                <ul>
                    <li>Private bedrooms</li>
                    <li>Full-size beds</li>
                    <li>Private or shared bathrooms - depending on style</li>
                    <li>Washer and dryer in each apartment</li>
                    <li>Full kitchen (microwave, refrigerator, stove, dishwasher, garbage disposal, and dining table with chairs)</li>
                    <li>Fully furnished living room (couch, table, chairs, TV stand and end table)</li>
                    <li>Central air and heat</li>
                    <li><strong>Dimensions:</strong></li>
                    <li><strong>Living Room Window:</strong> Width (78 in.) | Height (59 in.)</li>
                    <li><strong>Bedroom Window:</strong> Width (38 in.) | Height (58 in.)</li>
                    <li><strong>Closet:</strong> Width (55 in.) | Depth (27 in.)</li>
                </ul> `
                    },
                    "4 Bedroom Loft (2 Bath)": {
                        img: "../img/slideshow/reinhard-4-bedroom-loft-2-bath.png",
                        desc: `
                <ul>
                    <li>Private bedrooms</li>
                    <li>Full-size beds</li>
                    <li>Private or shared bathrooms - depending on style</li>
                    <li>Washer and dryer in each apartment</li>
                    <li>Full kitchen (microwave, refrigerator, stove, dishwasher, garbage disposal, and dining table with chairs)</li>
                    <li>Fully furnished living room (couch, table, chairs, TV stand and end table)</li>
                    <li>Central air and heat</li>
                    <li><strong>Dimensions:</strong></li>
                    <li><strong>Living Room Window:</strong> Width (78 in.) | Height (59 in.)</li>
                    <li><strong>Bedroom Window:</strong> Width (38 in.) | Height (58 in.)</li>
                    <li><strong>Closet:</strong> Width (55 in.) | Depth (27 in.)</li>
                </ul> `
                    }
                }
            }
        };


        const campusSelect = document.getElementById('campusSelect');
        const buildingSelect = document.getElementById('buildingSelect');
        const roomSelect = document.getElementById('roomSelect');
        const roomImage = document.getElementById('roomImage');
        const roomDesc = document.getElementById('roomDesc');

        campusSelect.addEventListener('change', function () {
            const campus = this.value;
            buildingSelect.innerHTML = '<option value=""></option>';
            roomSelect.innerHTML = '<option value=""></option>';
            buildingSelect.disabled = !campus;
            roomSelect.disabled = true;
            roomImage.style.display = "none";
            roomDesc.style.display = "none";

            if (campus && roomLayouts[campus]) {
                Object.keys(roomLayouts[campus]).forEach(building => {
                    const opt = document.createElement('option');
                    opt.value = building;
                    opt.textContent = building;
                    buildingSelect.appendChild(opt);
                });
            }
        });

        buildingSelect.addEventListener('change', function () {
            const campus = campusSelect.value;
            const building = this.value;
            roomSelect.innerHTML = '<option value=""></option>';
            roomSelect.disabled = !building;
            roomImage.style.display = "none";
            roomDesc.style.display = "none";

            if (campus && building && roomLayouts[campus]?.[building]) {
                Object.keys(roomLayouts[campus][building]).forEach(room => {
                    const opt = document.createElement('option');
                    opt.value = room;
                    opt.textContent = room;
                    roomSelect.appendChild(opt);
                });
            }
        });

        roomSelect.addEventListener('change', function () {
            const campus = campusSelect.value;
            const building = buildingSelect.value;
            const room = this.value;
            const layout = roomLayouts[campus]?.[building]?.[room];

            if (layout) {
                roomImage.src = layout.img;
                roomImage.style.display = "block";
                roomDesc.innerHTML = layout.desc;
                roomDesc.style.display = "block";
            } else {
                roomImage.style.display = "none";
                roomDesc.style.display = "none";
            }
        });
    </script>


    <?php
    require_once '../view/footer.php'; // This requires the footer
    ?>