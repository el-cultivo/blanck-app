<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" >
        <link rel="stylesheet" href="{{ asset('css/materialNote.css') }}">

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" charset="utf-8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js" charset="utf-8"></script>
        <script type="text/javascript" src="/js/ckMaterializeOverrides.js"></script>
        <script type="text/javascript" src="/js/materialNote.js"></script>
    </head>
    <body>

        <div class="row section">
            <div class="col">
                <!-- Modal Trigger -->
                <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>
                <p>You have to include jQuery and Materialize JS + CSS for the modal to work. You can include it from <a href="http://materializecss.com/getting-started.html">CDN (getting started)</a>.
            </div>
        </div>

        <!-- Modal Structure -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <h4>Modal Header</h4>
                <p>A bunch of text</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
            </div>
        </div>

        <textarea name="edit" class="materialnote_JS" id="first" rows="8" cols="80"></textarea>

        <textarea class="materialnote_JS" id="first">
            <h2 id="title">The Art of War</h2>
            <p>
                <blockquote>
                    If you know the enemy and know yourself, you need not fear the result of a hundred battles.<br> If you know yourself but not the enemy, for every victory gained you will also suffer a defeat.<br>
                    If you know neither the enemy nor yourself, you will succumb in every battle.
                </blockquote>

                <ul>
                    <li>If your enemy is secure at all points, be prepared for him. If he is in superior strength, evade him.</li>
                    <li>If your opponent is temperamental, seek to irritate him.</li>
                    <li>Pretend to be weak, that he may grow arrogant.</li>
                    <li>If he is taking his ease, give him no rest.</li>
                    <li>If his forces are united, separate them.</li>
                    <li>If sovereign and subject are in accord, put division between them. Attack him where he is unprepared, appear where you are not expected.</li>
                </ul>

                <ol>
                    <li>There are not more than five musical notes, yet the combinations of these five give rise to more melodies than can ever be heard.</li>
                    <li>There are not more than five primary colours, yet in combination</li>
                    <li>they produce more hues than can ever been seen.</li>
                    <li>There are not more than five cardinal tastes, yet combinations of</li>
                    <li>them yield more flavours than can ever be tasted.</li>
                </ol>

                <span style="font-weight: bold; background-color: rgb(156, 39, 176); color: rgb(250, 250, 250);">
                    There are roads which must not be followed, armies which must not be attacked, towns which must not be sieged, positions which must not be contested, commands of the sovereign which must not be obeyed.
                </span>
            </p>
        </textarea>

        <script type="text/javascript">
            $(document).ready(function(){
                var toolbar = [
                    ['style', ['style', 'bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fonts', ['fontsize', 'fontname']],
                    ['color', ['color']],
                    ['undo', ['undo', 'redo', 'help']],
                    ['ckMedia', ['ckImageUploader', 'ckVideoEmbeeder']],
                    ['misc', ['link', 'picture', 'table', 'hr', 'codeview', 'fullscreen']],
                    ['para', ['ul', 'ol', 'paragraph', 'leftButton', 'centerButton', 'rightButton', 'justifyButton', 'outdentButton', 'indentButton']],
                    ['height', ['lineheight']],
                ];

        		var materialnote = $('.materialnote_JS');

        		if (materialnote.length > 0) {
        	        materialnote.materialnote({
        				toolbar: toolbar,
        	            height: 550,
        	            minHeight: 100,
        	            defaultBackColor: '#fff'
        	        });
        			$(".note-editor").find("button").attr("type", "button");
        		}
            });
        </script>
    </body>
</html>
