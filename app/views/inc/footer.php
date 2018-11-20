    
    <footer class="page-footer light-blue">
        <div class="section-footer">
            <div class="container">
                <div class="row">
                    <div class="col s12 m3 center">
                        <h5 class="white-text"><strong><?php echo SITENAME; ?></strong></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright light-blue darken-1">
            <div class="container">
                <div class="row">
                    <div class="col s12 m3 center">
                        <p><?php echo '© ' . date('Y') . ' Copyright ' . SITENAME; ?></p>
                    </div>
                    <div class="col s12 m3 offset-m6 social-icons">
                        <ul class="center">
                            <li>
                                <a href="https://www.linkedin.com/in/lucaswolfe/" target="_blank" class="white-text">
                                    <i class="fab fa-linkedin fa-2x"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/in/lucaswolfe/" target="_blank" class="white-text">
                                    <i class="fab fa-stack-overflow fa-2x"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/in/lucaswolfe/" target="_blank" class="white-text">
                                    <i class="fab fa-github-square fa-2x"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.strava.com/athletes/9994629/" target="_blank" class="white-text">
                                    <i class="fab fa-strava fa-2x"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

   <script src="<?php echo URLROOT; ?>/js/jquery-3.3.1.min.js"></script>
   <script src="<?php echo URLROOT; ?>/js/materialize.min.js"></script>
    <script src="<?php echo URLROOT; ?>/js/main.js"></script>

    <script>
        $(document).ready(function () {
            
            $('.nav-dropdown-trigger').dropdown({
                    coverTrigger: false,
                    alignment: 'right',
                    constrainWidth: false,
                    hover: true
                    
                }
            );

            $('.menu-dropdown-trigger').dropdown({
                    coverTrigger: false,
                    alignment: 'center',
                    constrainWidth: false
                    
                }
            );

            $('select').formSelect();
            


            <?php if(isLoggedIn()) : ?>

            $('.modal').modal({
                startingTop: '30%',
                dismissible: false
            });
            
            $('.todos-dropdown-trigger').dropdown({
                    coverTrigger: false,
                    alignment: 'right',
                    constrainWidth: false,
                    hover: true
                    
                }
            );
            <?php if(checkUrl('todos/active') || checkUrl('todos/overview')): ?>
            $('#todo-description, #todo-name').characterCounter();
            
            $('.datepicker').datepicker();
            <?php endif; ?>
        <?php endif; ?>
        });

    </script>
            
</body>




</html>