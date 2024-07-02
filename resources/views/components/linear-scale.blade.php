<div class="card question-box rounded-4">
    <div class="card-body">
        <input type="hidden" id="question_id">
        <div class="col-lg-12">
            <h5 id="question">Question with Scale Answer</h5>
            <div class="d-flex flex-wrap mb-1">
                @for ($i = 1; $i <= 10; $i++)
                    <div class="col-2 col-sm-2 col-md-2 col-lg-1 form-check mb-2">
                        <input type="radio" class="form-check-input" id="option{{ $i }}" name="accessType" value="">
                        <label class="form-check-label" for="privateRadio">{{ $i }}</label>
                    </div>
                @endfor
            </div>            
        </div>      
    </div>
</div>



