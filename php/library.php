<?php
// displays the library and its contents

    include_once 'session_check.php';
    $help_available = false;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Library</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../js/popup.js"></script>
		<script>
			$(document).ready(function() {

                $(document).on('click', '#phonetics', function() {
                    $('#start_screen').hide();
                    $('#phonetics_content').show();
                });
                $(document).on('click', '#morphology', function() {
                    $('#start_screen').hide();
                    $('#morphology_content').show();
                });
                $(document).on('click', '#syntax', function() {
                    $('#start_screen').hide();
                    $('#syntax_content').show();
                });

                $(document).on('click', '.back_library', function() {
                    $('.lib_content').hide();
                    $('#start_screen').show();
                });

                $('#consonants_pic').my_popup({ // display bigger version of consonantal chart
                    name: 'consonants_picture',
                    url: 'consonants_pic.php',
                    height: 310,
                    width: 850
                });
            });
		</script>
    </head>
    <body>
        <div id="frame">
            <div class="allcontent">
                
                <!-- MAIN LIBRARY -->
                <div id="start_screen">
    		        <p>Welcome to the library!</p>
                    <p>You feel you need to refresh your knowledge of some important linguistic concepts in order to succeed in your quest? 
                      Click on one of the subject areas below to access instructive material that will help you to revise the central concepts of that area.</p>
                    <p class="centered">
                        <img src="../images/library.png" alt="Books" width="400px" height="460px" usemap="#library_map">
                        <map name="library_map">
                            <area shape="rect" coords="87,67,153,448" id="phonetics">
                            <area shape="rect" coords="159,122,205,453" id="morphology">
                            <area shape="rect" coords="209,173,252,457" id="syntax">
                        </map>
                    </p>
                </div>
                
                <!-- PHONETICS/PHONOLOGY SECTION -->
                <div class="lib_content hidden" id="phonetics_content">
                    <div class="open_book">
                        <div class="book_content_left">
                            <h3>Phonetics / Phonology</h3>
                            <p>IPA Symbols</p>
                            <ul>
                                <li>Vowels:</li>
                            </ul>
                            <img src="../images/vowels.png" width="300px" height="215px" alt="Vowel Chart"><br>
                            <p><button class="back_library">Back to Library</button></p>
                        </div>
                        <div class="book_content_right">
                            <ul>
                                <li>Consonants:</li>
                            </ul>
                            <img src="../images/consonants.png" id="consonants_pic" width="300px" height="102px" alt="Consonant Chart" title="Click to enlarge!"><br><br>
                            Sound System of English:<br>
                            <iframe width="300" height="179" src="//www.youtube.com/embed/9O3WmFnt5ag" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                
                <!-- MORPHOLOGY SECTION -->
                <div class="lib_content hidden" id="morphology_content">
                    <div class="open_book">
                        <div class="book_content_left">
                            <h3>Morphology</h3>
                            Useful definitions:
                            <ul>
                                <li><em>stem:</em> form of a word without any affixes are attached to it</li><br>
                                <li><em>inflectional morpheme:</em> morpheme that does not change a word’s category, but does serve as tense, number, possession, or comparison marker</li><br>
                                <li><em>derivational morpheme:</em> morpheme that changes the category of a word - for example from an adjective to a noun</li>
                            </ul>
                        </div>
                        <div class="book_content_right">
                            <br><br>
                            Different types of affixes:<br><br>
                            <iframe width="300" height="179" src="//www.youtube.com/embed/-J3w2S3nUG4" frameborder="0" allowfullscreen></iframe>
                            <br><br>
                            <p class="right_aligned"><button class="back_library">Back to Library</button></p>
                        </div>
                    </div>
                </div>
                
                <!-- SYNTAX SECTION -->
                <div class="lib_content hidden" id="syntax_content">
                    <div class="open_book">
                        <div class="book_content_left">
                            <h3>Syntax (X-Bar Syntax)</h3>
                            Different kinds of phrases in X-Bar Syntax:
                            <ul>
                                <li>AP - <a href="https://www.youtube.com/watch?v=nN4XwxX45Aw" target="_blank">Adjectival Phrase</a></li>
                                <li>AdvP - <a href="https://www.youtube.com/watch?v=E60pVnd07Q4" target="_blank">Adverb Phrase</a></li>
                                <li>NP - <a href="https://www.youtube.com/watch?v=Spy3TEm51Bw" target="_blank">Noun Phrase</a></li>
                                <li>PP - <a href="https://www.youtube.com/watch?v=5MmjKZAfkuY" target="_blank">Prepositional Phrase</a></li>
                                <li>VP - <a href="https://www.youtube.com/watch?v=Cpcnwjpbgxw" target="_blank">Verb Phrase</a></li>
                                <li>IP - <a href="https://www.youtube.com/watch?v=uoRm93Mbkwc" target="_blank">Inflectional Phrase</a></li>
                                <li>CP - <a href="https://www.youtube.com/watch?v=XjRpiq2sbDU" target="_blank">Complementizer Phrase</a></li>
                            </ul>
                            <br><br>
                            <em>Click on the names to watch explanatory videos on YouTube!</em>
                        </div>
                        <div class="book_content_right">
                            <br><br>
                            General structure of a phrase in X-Bar syntax:<br><br>
                            <p class="centered">
                                <img src="../images/general_syntax_tree.jpg" width="134px" height="161px">
                            </p>
                            <p class="right_aligned"><button class="back_library">Back to Library</button></p>
                        </div>
                    </div>
                </div>
                
            </div>
            <?php include 'page_elements/bottom_pane.php'; ?>
        </div>
    </body>
</html>