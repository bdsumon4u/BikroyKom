@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
@endpush

<!-- The Modal -->
<div class="modal" id="multi-picker">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header p-3">
                <h4 class="modal-title">Image Picker</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-3">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responive">
                            <table class="table table-bordered table-striped table-hover multi-picker w-100" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="150">Preview</th>
                                        <th>Filename</th>
                                        <th>Mime</th>
                                        <th>Size</th>
                                        <th width="10">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer p-3">
                <button type="button" class="btn btn-done btn-success" style="display: none;"></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
@endpush

@push('scripts')
<script>
    var table = $('.multi-picker').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! route('api.images.multiple') !!}",
        columns: [
            { data: 'preview' },
            { data: 'filename', name: 'filename' },
            { data: 'mime', name: 'mime' },
            { data: 'size_human', name: 'size' },
            { data: 'action' },
        ],
        order: [
            [1, 'desc']
        ],
    });

    table.on('draw', function () {
        var selected = @json($selected ?? []);
        for (var index = 0; index < selected.length; index++) {  
            $('#multi-select-'+selected[index]).prop('checked', true);
        }
    });

    $('#multi-picker').on('change', '.select-image', function (ev) {
        var selected = [],
            $additional_images = $('#additional-images'),
            additional_images_srcs = [],
            $additional_images_previews = $('.additional_images-previews');

        $('#multi-picker .select-image:checked').each(function (i, el) {
            if ($.inArray($(el).data('id'), selected) == -1) {
                selected.push($(el).data('id'));
                additional_images_srcs.push($(el).data('src'));
            }
        });

        $('.btn-done').show().text('Done ['+selected.length+']');

        $('.btn-done').on('click', function () {
            $additional_images.empty();
            $additional_images_previews.empty();
            for (var index = 0; index < selected.length; index++) {
                $additional_images_previews.append('<img src="'+additional_images_srcs[index]+'" alt="Additional Image" id="additional_image-preview" class="img-thumbnail img-responsive" style="height: 150px; width: 150px; margin: 5px;">');
                $additional_images.append('<input type="hidden" name="additional_images[]" value="'+selected[index]+'">');
                $additional_images.append('<input type="hidden" name="additional_images_srcs[]" value="'+additional_images_srcs[index]+'">');
            }
            $(this).parents('.modal').modal('hide');
        });
    })
</script>
@endpush