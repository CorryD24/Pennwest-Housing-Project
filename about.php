<?php
$title = "About";
require_once '../view/header.php';
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FAQ and Contact Page</title>

<script>
    function toggleAccordion(index) {
        const allContents = document.querySelectorAll('.accordion-content');

        allContents.forEach((content, i) => {
            if (i === index) {
                content.style.display = (content.style.display === 'block') ? 'none' : 'block';
            } else {
                content.style.display = 'none';
            }
        });

    }

    function centerMap(campus) {
        const centers = {
            clarion: [41.2133, -79.3805],
            california: [40.0638, -79.8869],
            edinboro: [41.8738, -80.1291]
        };
        if (campus in centers) {
            map.setView(centers[campus], 17);
        }
    }
</script>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 style="margin-top: 20px; text-align: center;">Frequently Asked Questions</h2>
            <p style="text-align: center;">Contact information is displayed at the bottom.</p>

            <div class="accordion">
                <?php
                $accordionData = [
                    [
                        'title' => '   What is a waitlist request?',
                        'content' => 'Waitlist requests are submitted during active room selection.  This for students who have completed housing applications, tried to pick a room but could not find the room style they wanted to accommodate them and/or their roommate group.  Residence Life and Housing will accommodate waitlist requests through the middle of July (the date is posted each year on our webpage www.pennwest.edu/room-selection ).  Fulfillment of a waitlist request is not guaranteed.  While Residence Life and Housing will do their best to meet all requests, it will depend upon the availability of spaces.'
                    ],
                    ['title' => 'What is a room change request?', 'content' => 'Room changes are requested after the semester has started by students who have already moved into a space but would like to go a different room or room type. Students are welcome to submit a room change request throughout the semester. Our Assistant Directors will review the requests and work with the student to find a suitable space. Fulfillment of a room change request is not guaranteed. While Residence Life and Housing will do their best to meet all requests, it will depend upon the availability of spaces. Room changes are also not always free. Typically, there is a free room change period after the first two weeks of a semester (thought not always guaranteed to occur). Room changes that are requested after the free room change period will be reviewed on a case-by-case basis and charges determined by the staff. Please, reach out to your building staff if you have specific questions about room changes or potential charges.'],
                    ['title' => 'How do I submit a waitlist request?', 'content' => '<p>Download the current <a href="../datafiles/user_guide.docx" download>User Guide</a></p>'],
                    ['title' => 'Is it guaranteed my waitlist request will be filled?', 'content' => 'There are no guarantees that a Waitlist request will be fulfilled. Space availability is based upon the most current occupancy numbers, other pending waitlist requests, and other contributing factors. The deadline for all room adjustments is mid July (the specific date is posted on our webpage each year), which means that any Waitlist Request not satisfied will be closed after this date.'],
                    ['title' => 'Does everyone in my group need to submit a waitlist request?', 'content' => 'No, not every student in a group needs to submit a request. In fact, it is preferred only one student submits a request for the entire group. There is an opportunity to input your preferred roommates names into the request form.'],
                    ['title' => 'How do I know if my waitlist request will be granted?', 'content' => 'You and your roommates (if applicable) will receive an email from rmassign@pennwest.edu with an offer to move. The email will tell you the room type being offered and the building. You will have a deadline to respond to the email confirming you wish to move. Please, watch for these emails, because your deadline will only be one or two weeks out from the date the email was sent. Anybody wishing to move (including your roommates) will need to respond to the email. Residence Life and Housing cannot move a student based on the request of another student, so everyone needs to respond on their own. (This is required in case a student has changed their mind since the submission of the waitlist).'],
                    ['title' => 'What will happen if I do not respond to the waitlist offer or miss the deadline?', 'content' => 'After the deadline, students who did not respond will be bumped to the bottom of the list. That does not mean that your waitlist will not be honored at some point, but you will need to wait until your name comes up on the list again after other students above you have had a chance to respond to offers.'],
                    ['title' => 'How do I submit a room change request?', 'content' => '<p>Download the current <a href="../datafiles/user_guide.docx" download>User Guide</a></p>'],
                    ['title' => 'Is it guaranteed my room change request will be granted?', 'content' => 'No, it is not guaranteed that your room change request will be granted. Room changes are determined and approved by the department and dependent on the availability of spaces. Residence Life and Housing tries to meet all requests to the best of their ability, but they cannot guarantee the request will be approved or fulfilled.'],
                    ['title' => 'How do I know if my room change request will be granted?', 'content' => 'The Assistant Director who oversees your building will reach out to you via email with the opportunity to change rooms.']
                ];


                foreach ($accordionData as $index => $section): ?>
                    <div class="accordion-item">
                        <div class="accordion-title" onclick="toggleAccordion(<?= $index ?>)">
                            <?= htmlspecialchars($section['title']) ?>
                        </div>
                        <div class="accordion-content" id="content-<?= $index ?>" style="display: none;">
                            <?= ($section['content']) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <h2 id="map-title" style="margin-top: 40px; text-align: center; display: none;">Campus Interactive Map</h2>

            <!-- Campus Selector -->
            <div id="campus-buttons" style="display: none; margin-top: 1rem; text-align: center;">
                <label><input type="radio" name="campus" onclick="centerMap('clarion')"> Clarion</label>
                <label style="margin-left: 20px;"><input type="radio" name="campus" onclick="centerMap('california')">
                    California</label>
                <label style="margin-left: 20px;"><input type="radio" name="campus" onclick="centerMap('edinboro')">
                    Edinboro</label>
            </div>

            <!-- Map Container -->
            <div id="map-wrapper" style="display: none; gap: 1rem; margin-top: 1rem; flex-wrap: wrap;">
                <div id="map" style="height: 500px; width: 70%; border: 1px solid #ccc;"></div>
                <div id="map-sidebar" style="width: 28%; padding: 1rem; border: 1px solid #ccc;">
                    <h4>Click on a marker to see building information here.</h4>
                </div>
            </div>

            <!-- Toggle Button -->
            <button onclick="toggleMap()"
                style="position: fixed; bottom: 20px; left: 20px; padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; z-index: 1000;">
                Toggle Map
            </button>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    let map;
    const buildings = [
        // --- Clarion Buildings ---
        { name: "Becker Hall", lat: 41.20601, lng: -79.37974, description: "Communication and Computer Science Majors", image: "../img/slideshow/Clarion Campus Images/beckerhall.jpg" },
        { name: "Carlson Library", lat: 41.21059, lng: -79.38017, description: "Library and Research Services", image: "../img/slideshow/Clarion Campus Images/carlsonlibrary.jpg" },
        { name: "Central Services (Mail Room)", lat: 41.20970, lng: -79.37559, description: "Mail and Packages", image: "../img/slideshow/Clarion Campus Images/centralservices.jpg" },
        { name: "Davis Hall", lat: 41.20995, lng: -79.38086, description: "English and Modern Language Majors", image: "../img/slideshow/Clarion Campus Images/Davis 1.jpg" },
        { name: "Eagle Commons Dining Hall", lat: 41.21107, lng: -79.37895, description: "Dining Location", image: "../img/slideshow/Clarion Campus Images/eaglecommonsdininghall.jpg" },
        { name: "Founders Hall", lat: 41.21125, lng: -79.37978, description: "History and Social Science Majors", image: "../img/slideshow/Clarion Campus Images/foundershall.jpg" },
        { name: "Science and Technology Center", lat: 41.21143, lng: -79.37981, description: "STEM Related Fields and Planetarium", image: "../img/slideshow/Clarion Campus Images/scienceandtechnologycenter.jpg" },
        { name: "Marwick-Boyd", lat: 41.20700, lng: -79.37999, description: "Arts (Performance and Otherwise)", image: "../img/slideshow/Clarion Campus Images/marwickboyd.jpg" },
        { name: "Ralston Hall", lat: 41.20849, lng: -79.37796, description: "Houses the Nursing Labs, and the Emergency Medical Technician Courses", image: "" },
        { name: "Speech and Hearing Clinic", lat: 41.20483, lng: -79.38026, description: "Houses the Clinical Offices and Classrooms for Speech Language Pathology", image: "../img/slideshow/Clarion Campus Images/speechandhearingclinic.jpg" },
        { name: "Stevens Hall", lat: 41.21035, lng: -79.38085, description: "Education and Special Education Majors", image: "" },
        { name: "Tippin Gymnasium", lat: 41.20795, lng: -79.38023, description: "Athletic Venues and Offices", image: "../img/slideshow/Clarion Campus Images/tippingymnasium.jpg" },
        { name: "Gemmell Student Center", lat: 41.20779, lng: -79.37706, description: "Dining Option, Spirit Store, Offices, and Meeting Rooms", image: "../img/slideshow/Clarion Campus Images/gemmellstudentcenter.jpg" },
        { name: "Becht Hall", lat: 41.21039, lng: -79.37907, description: "Houses departments such as Admissions, Health Services, Academic Enrichment, Tutoring Services, and the Center for Student Development", image: "../img/slideshow/Clarion Campus Images/bechthall.jpg" },
        { name: "Still Hall", lat: 41.21238, lng: -79.37768, description: "College of Business Administration and Information Science Majors", image: "../img/slideshow/Clarion Campus Images/stillhall.jpg" },
        { name: "Campus View Suites", lat: 41.20904, lng: -79.37835, description: "Nursing, Medical Imaging, and Speech Pathology Majors, As Well As Athletes Due to Proximity to Tippin Gymnasium", image: "../img/slideshow/Clarion Campus Images/CV 1.jpg" },
        { name: "Suites on Main North", lat: 41.21156, lng: -79.37646, description: "Close to Still Hall, Eagle Commons Dining Hall, and Founders Hall", image: "../img/slideshow/Clarion Campus Images/suitesonmainnorth.jpg" },
        { name: "Valley View Suites", lat: 41.20968, lng: -79.37714, description: "Close to Speech and Hearing Clinic, Stevens Hall, Davis Hall, Ralston Hall, Science and Technology Center, Gemmell Student Center, and Becker Hall", image: "../img/slideshow/Clarion Campus Images/valleyviewsuites.jpg" },
        // --- California Buildings ---
        { name: "Ceramics Building", lat: 40.06557, lng: -79.88466, description: "Dedicated facility for hands-on instruction in ceramic arts", image: "../img/slideshow/California Campus Images/ceramicsbuilding.jpg" },
        { name: "Convocation Center", lat: 40.06318, lng: -79.88186, description: "Home court for the California Vulcans men's and women's basketball teams, as well as the volleyball team.", image: "../img/slideshow/California Campus Images/convocationcenter.jpg" },
        { name: "Coover Hall", lat: 40.06522, lng: -79.88363, description: "Department of Applied Engineering and Technology, and for Hands-0n Courses in Art and Graphic Design", image: "../img/slideshow/California Campus Images/cooverhall.jpg" },
        { name: "Duda Hall", lat: 40.06560, lng: -79.88732, description: "Criminal Justice, Business, and General Education", image: "../img/slideshow/California Campus Images/dudahall.jpg" },
        { name: "Eberly Hall", lat: 40.06677, lng: -79.88612, description: "Geology, Sciences, Computer Science, Geography, Vet Tech, and Mechatronics Engineering Programs", image: "../img/slideshow/California Campus Images/eberlyhall.jpg" },
        { name: "Frich Hall", lat: 40.06651, lng: -79.88546, description: "Although going to be torn down and rebuilt, this building host the university's Biology and Engineering programs", image: "../img/slideshow/California Campus Images/frichhall.jpg" },
        { name: "Gallagher Hall", lat: 40.06243, lng: -79.88245, description: "Originally constructed as a campus dining hall, now hosts the university's music programs", image: "../img/slideshow/California Campus Images/gallagherhall.jpg" },
        { name: "Hamer Hall", lat: 40.06411, lng: -79.88239, description: "Athletic Training, Physical Therapy, and Criminal Justice Programs", image: "../img/slideshow/California Campus Images/hamerhall.jpg" },
        { name: "Helsel Hall", lat: 40.06505, lng: -79.88310, description: "Graphics and Multimedia Design Department, Applied Engineering Technology, and Digital Media", image: "" },
        { name: "Mandarino Library", lat: 40.06494, lng: -79.88679, description: "History and Political Science Departments", image: "../img/slideshow/California Campus Images/mandarinolibrary.jpg" },
        { name: "Noss Hall", lat: 40.06477, lng: -79.88417, description: "Global Education Department", image: "../img/slideshow/California Campus Images/nosshall.jpg" },
        { name: "New Science Hall", lat: 40.06611, lng: -79.88394, description: "Chemistry and physics Department", image: "../img/slideshow/California Campus Images/newsciencehall.jpg" },
        { name: "Old Main Hall", lat: 40.06596, lng: -79.88504, description: "The University's oldest and most iconic building, originally constructed in 1870. Now serves as a central administrative building", image: "../img/slideshow/California Campus Images/oldmain.jpg" },
        { name: "Steele Hall", lat: 40.06423, lng: -79.88332, description: "Theater which is designed to accommodate large groups comfortably, making it an ideal location for conferences, performances and other significant events", image: "../img/slideshow/California Campus Images/steelehall.jpg" },
        { name: "Vulcan Hall", lat: 40.06573, lng: -79.88470, description: "Versatile entertainment venue which hosts a variety of performances and events", image: "../img/slideshow/California Campus Images/vulcanhall.jpg" },
        { name: "Watkins Hall", lat: 40.06632, lng: -79.88428, description: "Department of Business", image: "../img/slideshow/California Campus Images/watkinshall.jpg" },
        { name: "Kara Alumni House", lat: 40.06686, lng: -79.88709, description: "Home for the Office of University Development and Alumni Relations, welcoming alumni during regular business hours", image: "../img/slideshow/California Campus Images/karaalumnihouse.jpg" },
        { name: "Morgan Hall", lat: 40.06170, lng: -79.88160, description: "Rutledge Institute Day Care and Pre-school", image: "../img/slideshow/California Campus Images/morganhall.jpg" },
        { name: "South Hall", lat: 40.06579, lng: -79.88532, description: "One of Pennwest California's oldest and most historically significant buildings, being constructed between 1874 and 1876", image: "../img/slideshow/California Campus Images/southhall.jpg" },
        { name: "Herron Hall", lat: 40.06485, lng: -79.88519, description: "Student Recreation and Fitness Center", image: "../img/slideshow/California Campus Images/herronhall.jpg" },
        { name: "Natali Student Center", lat: 40.06303, lng: -79.88463, description: "Student Center that offers a comprehensive range of services, utilities, amenities, and spaces to support students", image: "../img/slideshow/California Campus Images/natalistudentcenter.jpg" },
        { name: "Residence Hall B", lat: 40.27946, lng: -79.52675, description: "Academic Offices, Speech and Language Clinic, Campus Police, Parking, Residence Life and Housing Main Office", image: "../img/slideshow/California Campus Images/residencehallb.jpg" },
        { name: "Guesman Hall", lat: 40.06237, lng: -79.88424, description: "Guesman Hall is a residence hall offering semi-suite accommodations. Each suite features two single bedrooms and a shared bathroom, providing students with privacy and comfort.", image: "../img/slideshow/California Campus Images/guesmanhall2.jpg" },
        { name: "Hall E", lat: 40.061902, lng: -79.884729, description: "Residence hall on Campus", image: "" },
        { name: "Johnson Hall", lat: 40.06392, lng: -79.88482, description: "Residence Hall which provides a comfortable and inclusive living environment", image: "../img/slideshow/California Campus Images/johnsonhall.jpg" },
        { name: "Carter Hall", lat: 40.06418, lng: -79.88621, description: "Health Center, Center for Wellness, Office of Students with Disabilities, and DEI Center", image: "../img/slideshow/California Campus Images/carterhall.jpg" },
        { name: "Smith Hall", lat: 40.06367, lng: -79.88675, description: "Residence Hall which offers access to common areas, recreation rooms, and special-interest wings to foster a sense of community and encourage collaboration among students", image: "../img/slideshow/California Campus Images/smithhall.jpg" },

        // --- Edinboro Buildings ---
        { name: "Baron-Forness Library", lat: 41.87064, lng: -80.12126, description: "Offers Extensive Resources for Students and Faculty. Also Houses the Bruce Art Gallery", image: "../img/slideshow/Edinboro Campus Images/baronfornesslibrary.jpg" },
        { name: "Butterfield Hall", lat: 41.86841, lng: -80.11973, description: "Gen Eds, Department of Education, and Education Courses", image: "../img/slideshow/Edinboro Campus Images/butterfieldhall.jpg" },
        { name: "Compton Hall", lat: 41.87225, lng: -80.12721, description: "Psychology and Communications Courses. Also Houses the Campus Radio Station", image: "../img/slideshow/Edinboro Campus Images/comptonhall.jpg" },
        { name: "Cooper Science Center", lat: 41.86922, lng: -80.12431, description: "Dedicated to the Science Programs and Research, Planetarium, and Museum", image: "../img/slideshow/Edinboro Campus Images/cooperhall.jpg" },
        { name: "Doucette Hall", lat: 41.87069, lng: -80.12800, description: "Digital Arts Programs", image: "../img/slideshow/Edinboro Campus Images/doucettehall.jpg" },
        { name: "Hendricks Hall", lat: 41.86980, lng: -80.12195, description: "Contains Various Administrative Departments and History Classes", image: "../img/slideshow/Edinboro Campus Images/hendrickshall.jpg" },
        { name: "Loveland Hall", lat: 41.87129, lng: -80.12644, description: "Art Courses, Metal Working, Ceramics, and Jewelry Making", image: "../img/slideshow/Edinboro Campus Images/lovelandhall.jpg" },
        { name: "Ross Hall", lat: 41.87039, lng: -80.12421, description: "Technology Help Center and Mathematics. Fresh Market is also Located Here. Fresh Market Offers Portable Grab-n-Go Foods, and Convenience Items such as Snacks", image: "../img/slideshow/Edinboro Campus Images/rosshall.jpg" },
        { name: "McNerney Hall", lat: 41.86833, lng: -80.12123, description: "Ghering Health Center is Located Here", image: "../img/slideshow/Edinboro Campus Images/mcnerneyhall.jpg" },
        { name: "Frank G. Pogue Student Center", lat: 41.87201, lng: -80.11954, description: "Student Services and Activities Housed Here", image: "../img/slideshow/Edinboro Campus Images/frankgpogue.jpg" },
        { name: "McComb Field House", lat: 41.87358, lng: -80.11952, description: "Open Pool and Athletics", image: "../img/slideshow/Edinboro Campus Images/mccombfieldhouse.jpg" },
        { name: "Police Station", lat: 41.87757, lng: -80.11877, description: "Ensures Campus Safety and Provides Information Services", image: "../img/slideshow/Edinboro Campus Images/policestation.jpg" },
        { name: "Van Houten", lat: 41.87085, lng: -80.11957, description: "Main Dining Hall for Campus", image: "../img/slideshow/Edinboro Campus Images/vanhouten.jpg" },
        { name: "Highlands 1", lat: 41.87256, lng: -80.11673, description: "First Year Focused Housing. Located close to Frank G. Pogue Student Center, the Van Houten Dining Hall, and the Baron-Forness Library", image: "../img/slideshow/Edinboro Campus Images/highlands1.jpg" },
        { name: "Highlands 2", lat: 41.87207, lng: -80.11647, description: "First Year Focused Housing. Located close to Frank G. Pogue Student Center, the Van Houten Dining Hall, and the Baron-Forness Library", image: "../img/slideshow/Edinboro Campus Images/highlands2.jpg" },
        { name: "Highlands 3", lat: 41.87166, lng: -80.11786, description: "Upperclassmen Housing and Houses the Honors Living Community (Living Communities Open to all Years). Located close to Frank G. Pogue Student Center, the Van Houten Dining Hall, and the Baron-Forness Library", image: "../img/slideshow/Edinboro Campus Images/highlands3.jpg" },
        { name: "Highlands 4", lat: 41.87106, lng: -80.11804, description: "Upperclassmen Housing and Houses the Art Living Community (Living Communities Open to all Years). Located close to Frank G. Pogue Student Center, the Van Houten Dining Hall, and the Baron-Forness Library", image: "../img/slideshow/Edinboro Campus Images/highlands4.jpg" },
        { name: "Highlands 5", lat: 41.87212, lng: -80.11787, description: "Upperclassmen Housing and Houses the STEM and Nursing Living Communities (Living Communities Open to all years). Located close to Frank G. Pogue Student Center, The Van Houten Dining Hall, and the Baron-Forness Library", image: "../img/slideshow/Edinboro Campus Images/highlands5.jpg" },
        { name: "Highlands 6", lat: 41.87273, lng: -80.11787, description: "Upperclassmen Housing Located close to Frank G. Pogue Student Center, the Van Houten Dining Hall, and the Baron-Forness Library. Closest to the McComb Field House", image: "../img/slideshow/Edinboro Campus Images/highlands6.2.jpg" },
        { name: "Highlands 7", lat: 41.86931, lng: -80.11830, description: "Upperclassmen Housing and Houses the Cultural Awareness, Gender Identity, and Quiet Living Communities (Living Communities open to all Years). Closest to Butterfield Hall, Ghering Health Center, and Hendricks Hall", image: "../img/slideshow/Edinboro Campus Images/highlands7.jpg" }
    ];
    document.addEventListener("DOMContentLoaded", function () {
        const streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        });

        const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri'
        });

        map = L.map('map', {
            center: [40.0641, -79.8870],
            zoom: 17,
            layers: [streetLayer]
        });

        const baseMaps = {
            "Street View": streetLayer,
            "Satellite View": satelliteLayer
        };
        L.control.layers(baseMaps).addTo(map);

        buildings.forEach(building => {
            const marker = L.marker([building.lat, building.lng]).addTo(map);
            marker.on('click', () => {
                let sidebarHtml = '';

                if (building.image) {
                    sidebarHtml += `<img src="${building.image}" alt="${building.name}" style="width: 100%; height: auto; border-radius: 8px; margin-bottom: 1rem;">`;
                }

                sidebarHtml += `<h4>${building.name}</h4>`;
                sidebarHtml += `<p>${building.description}</p>`;

                document.getElementById('map-sidebar').innerHTML = sidebarHtml;
            });
        });
    });

    function toggleMap() {
        const wrapper = document.getElementById('map-wrapper');
        const title = document.getElementById('map-title');
        const campusButtons = document.getElementById('campus-buttons');

        if (wrapper.style.display === "none") {
            wrapper.style.display = "flex";
            title.style.display = "block";
            campusButtons.style.display = "block";
            setTimeout(() => {
                map.invalidateSize();
            }, 100);
        } else {
            wrapper.style.display = "none";
            title.style.display = "none";
            campusButtons.style.display = "none";
        }
    }
</script>

<?php require_once '../view/footer.php'; ?>

