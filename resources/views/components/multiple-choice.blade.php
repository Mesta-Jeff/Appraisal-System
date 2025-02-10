<div class="card question-box rounded-4">
    <div class="card-body">
        <input type="hidden" id="question_id">
        <div class="col-lg-12">
            <h5 id="question">Question with Multiple Choice or Check Answer</h5>
            <div class="mb-1">
                @for ($i = 1; $i <=4 ; $i++)
                    <div class="col-6 form-check">
                        <input type="radio" class="form-check-input" id="option{{ $i }}" name="accessType" value="">
                        <label class="form-check-label" for="privateRadio">Option {{ $i }}</label>
                    </div>
                @endfor
            </div>
        </div>      
    </div>
</div>



