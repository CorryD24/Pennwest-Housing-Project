<!--This is the footer which will appear at the bottom of each page-->
<br>
<footer>

    <?php if (isset($_SESSION['Role']) && in_array('AG-ROLE-STUDENT', $_SESSION['Role'])) { //only shown to users with Student role ?>
        <!-- Contact Section -->
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-12">
                    <h3 style="text-align: center;">Contact Information</h3>
                    <div class="contact-section">
                        <div class="contact">
                            <h5 style="text-align: left;">Clarion</h5>
                            <h6 class="contactMargin">Phone: 814-393-2352</h6>
                            <h6 class="contactMargin">Email: clarionreslife@pennwest.edu</h6>
                            <h6 class="contactMargin">Address: 218 Becht Hall, 840 Wood Street, Clarion, PA 16214

                            </h6>
                            <h6 class="contactMargin">Hours: Monday – Friday, 8 am – 4 pm</h6>
                        </div>
                        <div class="contact">
                            <h5 style="text-align: left;">Edinboro</h5>
                            <h6 class="contactMargin">Phone: 814-732-2818</h6>
                            <h6 class="contactMargin">Email: bororeslife@pennwest.edu</h6>
                            <h6 class="contactMargin">Address: 215 Frank G. Pogue Student Center, 405 Scotland Road,
                                Edinboro, PA 16444
                            </h6>
                            <h6 class="contactMargin">Hours: Monday – Friday, 8 am – 4 pm</h6>
                        </div>
                        <div class="contact">
                            <h5 style="text-align: left;">California</h5>
                            <h6 class="contactMargin">Phone: 724-938-4444</h6>
                            <h6 class="contactMargin">Email: calreslife@pennwest.edu</h6>
                            <h6 class="contactMargin">Address: Room 140, Building B, 250 University Avenue, California, PA
                                15419
                            </h6>
                            <h6 class="contactMargin">Hours: Monday – Friday, 8 am – 4 pm</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>

    <button id="darkModeToggle">Toggle Dark Mode</button>

    <script>
        // Check for saved theme in localStorage
        const darkModeToggle = document.getElementById('darkModeToggle');
        const currentTheme = localStorage.getItem('theme');

        if (currentTheme === 'dark') {
            document.body.classList.add('dark-mode');
        }

        // Toggle Dark Mode
        darkModeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const theme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
            localStorage.setItem('theme', theme);
        });
    </script>

    <br>
    <br> <!--For looks-->
</footer>

</body>

</html>