    {{-- include-draw-popup-start --}}
    <div class="modal fade update-player-status-popup" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tournament Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('academy.getMatchScore') }}" method="post" id="score_submit_form"
                    class="update-player-status-form">
                    @csrf
                    <div class="modal-body row clearfix">

                        <div class="col-sm-12 form-group update-player-status-form-text " id="score">

                        </div>
                        <div class="col-sm-12 form-group update-player-status-form-radio" id="hiddendata">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="theme-btn-one modal-footer-close"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="theme-btn-one modal-footer-update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- include-draw-popup-end --}}
