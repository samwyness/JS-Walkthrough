<script type="text/javascript">
    // Define Global Variables
    var current_step, next_step, current_step_data;
    var screen_dimensions = {"width": 0, "height": 0};
    var modal_wrap, modal_container, modal_header, modal_body, modal_footer;

    // Set up the tour!
    var tour = {
        steps : {
            step_one : {
                element_id : "dash-mycourse",
                tip_title : "Your PDC Course",
                tip_content : "Here you'll find all the course lessons and descriptions.",
                next_step_link : "step_two"
            },
            step_two : {
                element_id : "dash-ask",
                tip_title : "Ask a Question",
                tip_content : "Write up a question and you'll get some answers.",
                next_step_link : "step_three"
            },
            step_three : {
                element_id : "dash-final",
                tip_title : "Final Project",
                tip_content : "Your Final Project.",
                next_step_link : "step_four"
            },
            step_four : {
                element_id : "af-home-sidebar",
                tip_title : "Sidebar",
                tip_content : "This is ya sidebar cobber.",
                next_step_link : "finsihed"
            }
        },
        exit_button : false
    };

    // Collect tour steps
    var story_board = tour.steps;

    // Wait for DOM content to load
    document.addEventListener('DOMContentLoaded', function() {
        // Setup the modal
        modal_wrap = document.getElementById('mf-modal-wrap');
        modal_container = document.getElementById('mf-modal-container');
        modal_header = document.getElementById('mf-modal-header');
        modal_body = document.getElementById('mf-modal-body');
        modal_footer = document.getElementById('mf-modal-footer');

        startTour();
    });


    ////////////////////
    // TOUR FUNCTIONS //
    ////////////////////

    // Start the tour
    function startTour() {
        // Loop through story_board keys
        for (var key in story_board) {
            // Find Step One and set as current_step
            if (key == "step_one") {
                current_step = key;
                current_step_data = story_board[key];
                // Set the next step
                next_step = story_board[key].next_step_link;
            }
        }

        // Get Element according to current_step_data
        var current_element = document.getElementById('' + current_step_data.element_id + '');

        setTimeout(function() {
            drawTooltip(current_element);
        }, 300);
    }

    // Go to next step
    function nextStep(current_element) {
        current_element.style.position = "";
        current_element.style.zIndex = "";

        current_step = next_step;
        // Loop through story_board keys
        for (var key in story_board) {
            if (key == current_step) {
                // Set the current_step
                current_step_data = story_board[key];
                // Set the next step
                next_step = current_step_data.next_step_link;
                // define the current_element
                current_element = document.getElementById('' + current_step_data.element_id + '');

                redrawTooltip(current_element);
            }
        }

        if (next_step == "finsihed") {
            finishTour(current_element);
        }
    }

    // Finsih Tour
    function finishTour(current_element) {
        modal_footer.innerHTML = "<div id=\"finish-btn\" class=\"mf-modal-footer-primary-btn\">FINISHED</div>";
        document.getElementById('finish-btn').addEventListener('click', function() {
            current_element.style.position = "";
            current_element.style.zIndex = "";
            toggleClass("mf-show", modal_wrap);
            toggleClass("mf-fade-in", modal_container);
            modal_header.innerHTML = "";
            modal_body.innerHTML = "";
            modal_footer.innerHTML = "";
        });
    }


    //////////////////
    // DRAW TOOLTIP //
    //////////////////

    function drawTooltip(current_element) {
        // Get screen dimensions
        screen_dimensions.height = document.body.clientHeight;
        screen_dimensions.width = document.body.clientWidth;

        // Loop through story_board keys
        for (var key in story_board) {
            if (key == current_step) {
                // Fill Tooltip
                modal_header.innerHTML = "<h3>" + story_board[key].tip_title + "</h3><div id='mf-modal-close' class='mf-modal-close'>&times;</div>";
                document.getElementById('mf-modal-close').addEventListener('click', function() {
                        toggleClass("mf-show", modal_wrap);
                        modal_header.innerHTML = "";
                        modal_body.innerHTML = "";
                        modal_footer.innerHTML = "";
                });

                modal_body.innerHTML = "" + story_board[key].tip_content + "";
                modal_footer.innerHTML = "<div id=\"next-btn\" class=\"mf-modal-footer-secondary-btn\">NEXT STEP</div>";
            }
        }
        document.getElementById('next-btn').addEventListener('click', function() {
            nextStep(current_element);
        });

        // Move Tooltip
        toggleClass("mf-show", modal_wrap);
        var element_specs = current_element.getBoundingClientRect();

        var modal_wrap_height = document.getElementById('mf-modal-wrap').getBoundingClientRect().height;
        var container_height = document.getElementById('mf-modal-container').getBoundingClientRect().height;
        var container_width = document.getElementById('mf-modal-container').getBoundingClientRect().width;

        if (element_specs.top >= (screen_dimensions.height / 2)) {
            modal_container.style.top = "" + (element_specs.top - container_height - 10) + "px";
            modal_container.style.left = "" + element_specs.left + "px";
        } else {
            modal_container.style.top = "" + (element_specs.top + element_specs.height + 10) + "px";
            modal_container.style.left = "" + element_specs.left + "px";
        }

        if (element_specs.top >= (screen_dimensions.height / 2)) {
            modal_container.style.top = "" + (element_specs.top - container_height - 10) + "px";
            modal_container.style.left = "" + element_specs.left + "px";
        } else {
            modal_container.style.top = "" + (element_specs.top + element_specs.height + 10) + "px";
            modal_container.style.left = "" + element_specs.left + "px";
        }

        setTimeout(function() {
            toggleClass("mf-fade-in", modal_container);
            current_element.style.position = "relative";
            current_element.style.zIndex = "999999";
        }, 200);
    }


    ////////////////////
    // REDRAW TOOLTIP //
    ////////////////////

    function redrawTooltip(current_element) {
        // Get screen dimensions
        screen_dimensions.height = document.body.clientHeight;
        screen_dimensions.width = document.body.clientWidth;

        // Loop through story_board keys
        for (var key in story_board) {
            if (key == current_step) {
                // Fill Tooltip
                modal_header.innerHTML = "<h3>" + story_board[key].tip_title + "</h3><div id='mf-modal-close' class='mf-modal-close'>&times;</div>";
                document.getElementById('mf-modal-close').addEventListener('click', function() {
                        toggleClass("mf-show", modal_wrap);
                        modal_header.innerHTML = "";
                        modal_body.innerHTML = "";
                        modal_footer.innerHTML = "";
                });

                modal_body.innerHTML = "" + story_board[key].tip_content + "";
                modal_footer.innerHTML = "<div id=\"next-btn\" class=\"mf-modal-footer-secondary-btn\">NEXT STEP</div>";
            }
        }
        // Add Event Listener to Next Button
        document.getElementById('next-btn').addEventListener('click', function() {
            nextStep(current_element);
        });

        // Move Tooltip
        var element_specs = current_element.getBoundingClientRect();

        var modal_wrap_height = document.getElementById('mf-modal-wrap').getBoundingClientRect().height;
        var container_height = document.getElementById('mf-modal-container').getBoundingClientRect().height;
        var container_width = document.getElementById('mf-modal-container').getBoundingClientRect().width;
        if (element_specs.top >= (screen_dimensions.height / 2)) {
            modal_container.style.top = "" + (element_specs.top - container_height - 10) + "px";
            modal_container.style.left = "" + element_specs.left + "px";
        } else {
            modal_container.style.top = "" + (element_specs.top + element_specs.height + 10) + "px";
            modal_container.style.left = "" + element_specs.left + "px";
        }

        if (element_specs.top >= (screen_dimensions.height / 2)) {
            modal_container.style.top = "" + (element_specs.top - container_height - 10) + "px";
            modal_container.style.left = "" + element_specs.left + "px";
        } else {
            modal_container.style.top = "" + (element_specs.top + element_specs.height + 10) + "px";
            modal_container.style.left = "" + element_specs.left + "px";
        }



        setTimeout(function() {
            current_element.style.position = "relative";
            current_element.style.zIndex = "999999";
        }, 200);
    }


    //////////////////////
    // HELPER FUNCTIONS //
    //////////////////////

    // Toggle Class
    function toggleClass(string, element) {
        if (element.className.indexOf(string) == -1) {
            element.className += " " + string;
        } else {
            element.className = element.className.replace(string, '');
            element.className = element.className.replace('  ', ' ');
        }
    }
</script>

<style type="text/css">
    .mf-modal-wrap {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        padding: 0 15px;
        background: rgba(255,255,255,0.90);
        z-index: 999999;
        overflow-x: hidden;
        overflow-y: auto;
    }
    .mf-modal-container {
        display: inline-block;
        /*display: block;*/
        position: relative;
        max-width: 450px;
        width: 100%;
        height: auto;
        margin: 0 auto;
        background: #fff;
        border: 1px solid #e1e2e3;
        border-radius: 4px;
        box-shadow: 0px 2px 8px rgba(0,0,0,0.34);
        z-index: 999950;
        opacity: 0;
        -webkit-transition: top 0.24s ease, left 0.24s ease, opacity 0.24s ease;
        -moz-transition: top 0.24s ease, left 0.24s ease, opacity 0.24s ease;
        -o-transition: top 0.24s ease, left 0.24s ease, opacity 0.24s ease;
        transition: top 0.24s ease, left 0.24s ease, opacity 0.24s ease;
    }
    .mf-modal-header {
        display: block;
        position: relative;
        max-height: 10vh;
        width: 100%;
        height: auto;
        padding: 1.5vh 2.5vh;
        background: #fff;
        border-radius: 4px 4px 0 0;
        z-index: 999999;
    }
    .mf-modal-header h3 {
        display: inline-block;
        position: relative;
        max-width: 90%;
        margin: 0;
        font-size: 2.6vh;
        line-height: 4.5vh;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }
    .mf-modal-close {
        float: right;
        display: inline-block;
        width: 4vh;
        height: 4vh;
        font-size: 5.5vh;
        color: #c7c7c7;
        line-height: 4.5vh;
        text-align: center;
        cursor: pointer;
    }
    .mf-modal-body {
        display: block;
        position: relative;
        max-height: 75vh;
        width: 100%;
        height: auto;
        padding: 2vh 2.5vh;
        background: #fff;
        font-size: 2.3vh;
        z-index: 999999;
        overflow-x: hidden;
        overflow-y: auto;
    }
    .mf-modal-footer {
        display: block;
        position: relative;
        max-height: 15vh;
        width: 100%;
        height: 11vh;
        padding: 2.5vh 2.5vh;
        background: #fff;
        border-radius: 0 0 4px 4px;
        z-index: 999999;
    }
    .mf-modal-footer-primary-btn,
    .mf-modal-footer-secondary-btn {
        display: inline-block;
        float: right;
        height: auto;
        width: auto;
        padding: 1.3vh 2.5vh;
        border-radius: 2px;
        font-size: 2vh;
        text-align: center;
        cursor: pointer;
    }
    .mf-modal-footer-primary-btn {
        background: #ff916c;
        border: 1px solid #ff916c;
        color: #fff;
    }
    .mf-modal-footer-secondary-btn {
        background: #f6f7f9;
        border: 1px solid #e1e2e3;
        color: #36454f;
    }

    .mf-show {
        display: block;
    }
    .mf-fade-in {
        opacity: 1;
    }
</style>

<!--MODAL-->
<div id="mf-modal-wrap" class="mf-modal-wrap">
    <div id="mf-modal-container" class="mf-modal-container">
        <div id="mf-modal-header" class="mf-modal-header"><!-- For Header use h3 Tag and add Close Modal Button '<div id="mf-modal-close" class="mf-modal-close">&times;</div>' --></div>
        <div id="mf-modal-body" class="mf-modal-body"></div>
        <div id="mf-modal-footer" class="mf-modal-footer"><!-- For Button styles use class name 'mf-modal-footer-btn' --></div>
    </div>
</div>
<!--/MODAL-->
