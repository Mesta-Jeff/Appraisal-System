<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Section;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\QuestionOption;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class QuestionController extends Controller
{
    //

    // TODO: THE APPRAISAL QUESTION
    public function Questions(Request $request)
    {
        if ($request->ajax()) {
            $questions = Question::join('sections as s', 's.id', '=', 'q.section_id')
                ->select('q.*', 's.title as section')
                ->from('questions as q')
                ->where('q.is_deleted', 'No')
                ->orderBy('q.id', 'desc')
                ->get();
            return response()->json(['status' => 'success', 'questions' => $questions]);
        }
        return view('settings.questions');
    }
    public function fetch_questions(Request $request)
    {
        $questions = DB::table('questions')->where('is_deleted', 'No')->orderBy('question_text', 'asc')->select('question_text', 'id')->get();
        return response()->json(['questions' => $questions]);
    }
    public function addQuestion(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }
        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'question_text' => 'required|array|min:1', 
                'question_text.*' => 'required|string|max:255',
                'section_id' => 'required|exists:sections,id',
                'question_for' => 'nullable|string',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }

            $questions = $request->input('question_text'); 
            $sectionId = $request->input('section_id');
            $questionFor = $request->input('question_for');

            foreach ($questions as $questionText) {
                // Check if the question already exists
                $existingQuestion = Question::where('question_text', $questionText)
                    ->where('is_deleted', 'No')
                    ->first();

                if ($existingQuestion) {
                    return response()->json(['status' => 'error', 'message' => 'Record already exists: ' . $questionText], 422);
                }

                // Save each question
                Question::create([
                    'question_text' => $questionText,
                    'section_id' => $sectionId,
                    'question_for' => $questionFor,
                ]);
            }

            return response()->json(['status' => 'success', 'message' => 'Questions saved successfully']);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'An error occurred during the operation.'], 500);
        }
    }

    
    public function updateQuestion(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'question_text' => 'required|string',
                'section_id' => 'required|exists:sections,id',
                'question_for' => 'nullable|string',
                'id' => 'required|exists:questions,id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }
            // Update the record with validated fields
            $updated = Question::where('id', $validator->validated()['id'])->update($validator->validated());

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record updated you can check it out']);
            }

            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be updated'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function destroyQuestion(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['id' => 'required|exists:questions,id',]);

            try {
                Question::where('id', $request->id)->update(['is_deleted' => 'Yes']);
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Operation failed.'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }


    

    // TODO: THE APPRAISAL QUESTION SECTION
    public function QuestionSection(Request $request)
    {
        if ($request->ajax()) {
            $sections = Section::orderBy('id', 'desc')->where('is_deleted','No')->get();
            return response()->json(['status' => 'success', 'sections' => $sections]);
        }
        return view('settings.question-section');
    }
    public function fetch_sections(Request $request)
    {
        $sections = DB::table('sections')->where('is_deleted', 'No')->orderBy('title', 'asc')->select('title', 'id')->get();
        return response()->json(['sections' => $sections]);
    }
    public function addSection(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'section' => 'nullable|string',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }

            // Check if already exists
            $existingSection = Section::where('title', $request->input('title'))->where('is_deleted','No')->first();
            if ($existingSection) {
                return response()->json(['status' => 'error', 'message' => 'Record already exists, try again with different record'], 422);
            }

            // Save the record with validated fields
            $instance = Section::create([
                'title' => $validator->validated()['title'],
                'section' => $validator->validated()['section'],
            ]);

            if ($instance->save()) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, data saved']);
            }
            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be saved'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function updateSection(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'section' => 'nullable|string',
                'id' => 'required|exists:sections,id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }
            // Update the record with validated fields
            $updated = Section::where('id', $validator->validated()['id'])->update([
                'title' => $validator->validated()['title'],
                'section' => $validator->validated()['section'],
            ]);

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record updated you can check it out']);
            }

            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be updated'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function destroySection(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['id' => 'required|exists:sections,id',]);

            try {
                Section::where('id', $request->id)->update(['is_deleted' => 'Yes']);
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Operation failed.'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }
  

    // TODO: THE GENERAL OPTIONS FOR QUESTIONS
    public function Options(Request $request)
     {
         if ($request->ajax()) {
             $data = Option::orderBy('id', 'desc')->where('is_deleted','No')->get();
             return response()->json(['status' => 'success', 'options' => $data]);
         }
         return view('settings.options');
    }
    public function fetch_options(Request $request)
    {
        $data = DB::table('options')->where('is_deleted', 'No')->orderBy('option_text', 'asc')->select('option_text', 'id')->get();
        return response()->json(['options' => $data]);
    }
    public function addOption(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'option_text' => 'required|string',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }

            // Check if already exists
            $existingSection = Option::where('option_text', $request->input('option_text'))->where('is_deleted','No')->first();
            if ($existingSection) {
                return response()->json(['status' => 'error', 'message' => 'Record already exists, try again with different record'], 422);
            }

            // Save the record with validated fields
            $instance = Option::create($validator->validated());

            if ($instance->save()) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, data saved']);
            }
            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be saved'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function updateOption(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'option_text' => 'required|string',
                'id' => 'required|exists:options,id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }
            // Update the record with validated fields
            $updated = Option::where('id', $validator->validated()['id'])->update($validator->validated());

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record updated you can check it out']);
            }

            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be updated'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function destroyOption(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['id' => 'required|exists:options,id',]);

            try {
                Option::where('id', $request->id)->update(['is_deleted' => 'Yes']);
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Operation failed.'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }


    // TODO: THE APPRAISAL QUESTIONS AND OPTIONS
    public function QuestionOption(Request $request)
    {
        if ($request->ajax()) {
            // Ensure that question_id is provided in the request
            $questionId = $request->input("question_id");
            if (!$questionId) {
                return response()->json(['status' => 'error', 'message' => 'Question ID is required.']);
            }

            Log::info('Received Question ID: ' . $questionId);

            // Fetch data from the database
            $data = DB::table('question_options as qo')
                ->join('questions as q', 'qo.question_id', '=', 'q.id')
                ->join('options as o', 'qo.option_id', '=', 'o.id')
                ->where('qo.is_deleted', 'No')
                ->where('qo.question_id', $questionId)
                ->orderBy('qo.id', 'desc')
                ->select('qo.*', 'q.question_text', 'o.option_text')
                ->get();

            return response()->json(['status' => 'success', 'QuestionOptions' => $data]);
        }

        // Return view for non-AJAX requests
        return view('settings.question-options');
    }

    public function addQuestionOption(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            
            // Validate the input
            $validator = Validator::make($request->all(), [
                'question_id' => 'required|exists:questions,id',
                'option_id' => 'required|exists:options,id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }

            // Check if already exists
            $existingSection = QuestionOption::where('option_id', $request->input('option_id'))->where('question_id', $request->input('question_id'))->where('is_deleted','No')->first();
            if ($existingSection) {
                return response()->json(['status' => 'error', 'message' => 'Record already exists, try again with different record'], 422);
            }

            // Save the record with validated fields
            $instance = QuestionOption::create($validator->validated());

            if ($instance->save()) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, data saved']);
            }
            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be saved'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function updateQuestionOption(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'question_id' => 'required|exists:questions,id',
                'option_id' => 'required|exists:options,id',
                'id' => 'required|exists:question_options,id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }
            // Update the record with validated fields
            $updated = QuestionOption::where('id', $validator->validated()['id'])->update($validator->validated());

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record updated you can check it out']);
            }

            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be updated'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function destroyQuestionOption(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['id' => 'required|exists:options,id',]);

            try {
                QuestionOption::where('id', $request->id)->update(['is_deleted' => 'Yes']);
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Operation failed.'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }



    // STUDENT QUESTIONAIRES
    public function studentQuestionaires(Request $request)
    {
        /* if ($request->ajax()) {
            $query = "SELECT s.title as section, q.question_text, q.question_for, o.option_text, q.section_id, qo.question_id, qo.option_id, qo.id as question_option_id FROM questions q LEFT JOIN sections s on s.id = q.section_id INNER JOIN question_options qo on qo.question_id = q.id INNER JOIN options o on o.id = qo.option_id GROUP BY s.title, q.question_text, q.question_for, q.section_id, qo.question_id, qo.option_id, o.option_text, qo.id ORDER BY s.title;";
            $data = DB::select($query);
            
            return response()->json(['status' => 'success', 'Questions' => $data]);
        } */
        // Your logic here
        return view('student-questionaires');
    }

    

}
