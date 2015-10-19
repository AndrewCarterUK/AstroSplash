<?php $this->layout('app::layout', ['title' => 'Astronomy Picture of the Day']) ?>

<h1 class="text-center">AstroSplash</h1>
<p class="text-center">Images courtesy of NASA</p>

<div id="gallery" class="row"></div>

<div class="text-center">
    <button id="more" class="btn btn-primary">More...</button><br /><br />
</div>

<div id="modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 id="modal-title" class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <img id="modal-image" src="" alt="" class="img-responsive" />
            </div>
            <div class="modal-footer">
                <p id="modal-caption"></p>
            </div>
        </div>
    </div>
</div>

<?php $this->start('css') ?>
    <style type="text/css">
        body, html { background: #303030; color: white; }
        #modal { color: black; }
        #modal-caption { text-align: justify; }
        #gallery .thumb { border: 1px solid white; margin-bottom: 1.5em; }
    </style>
<?php $this->stop() ?>

<?php $this->start('javascript') ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        var requestInProgress = false;
        var currentPage = 0;

        $(document).ready(function () {
            $('#more').click(function () {
                if (requestInProgress) return;
                requestInProgress = true;

                $.get('/picture-list/' + currentPage, function (data) {
                    currentPage++; requestInProgress = false;

                    $.each(data, function (date, picture) {
                        if (picture.media_type == 'image') {
                            $('#gallery').append([
                                '<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">',
                                    '<a id="' + date + '" href="' + picture.url + '" data-lightbox="gallery" data-title="Hello">',
                                        '<img src="' + picture.thumbnail_url + '" title="' + picture.title + '" class="img-responsive thumb" alt="" />',
                                    '</a>',
                                '</div>'
                            ].join(''));
    
                            $('#' + date).click(function (event) {
                                event.preventDefault();
  
                                $('#modal-title').text(picture.title);
                                $('#modal-image').attr('src', picture.url);
                                $('#modal-caption').text(picture.explanation);
                                $('#modal').modal();
                            });
                        }
                    });
                });
            }).click();
        });
    </script>
<?php $this->stop() ?>
