<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use App\Models\Project;
use App\Models\Subject;
use App\Models\Resource;
use App\Models\Environment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mechanism;
use Illuminate\Support\Facades\Validator;


class projectsController extends Controller
{
    
    function splitArray($concatenatedString, $separator = '|') {
        return explode($separator, $concatenatedString);
    }
    
    public function index(){
        // $projects = Project::select(['id','title','logo', 'abstract',
        //     'overview',
        //     'image',
        //     'launchd',
        //     'proponent',
        //     'progress',
        //     'problems',
        //     'solution',
        //     'completion',
        //     'output',
        //     'costing',
        //     'future'])->get();
            
        // $data =[
        //     'projects' => $projects

        // ];
        // return response()->json($data, 200);

        $projects = Project::all();

        $container = [];
        foreach ($projects as $project) {
            $container[] = [
                'id' => $project->id,
                'title' => $project->title,
                'logo' => $project->logo,
                'description' => $project->description,
                'abstract' => $project->abstract,
                'overview' => $project->overview,             
                'image' => $project->image,          
                'link' => "/sdg/project/{$project->id}/{$project->title}",
                'tags' => [
                    'name' => $this->splitArray($project->tag->name),
                    'image' => $this->splitArray($project->tag->image),
                ],
                'objectives' => $this->splitArray($project->objectives),
                'subject' => [
                    'initiator'=> $this->splitArray($project->subject->initiator),
                    'leader'=> $this->splitArray($project->subject->leader),
                    'members'=> $this->splitArray($project->subject->members)
                ],
                'environment' => [
                    'nature'=> $this->splitArray($project->environment->nature),
                    'industry'=> $this->splitArray($project->environment->industry),
                    'government'=> $this->splitArray($project->environment->government)
                ],
                'resources' => [
                    'human'=> $this->splitArray($project->resource->human),
                    'financial'=> $this->splitArray($project->resource->financial),
                    'technical'=> $this->splitArray($project->resource->technical)
                ],
                'mechanism' => [
                    'planning' => $project->mechanism->planning,
                    'design' => $project->mechanism->design,
                    'installation' => $project->mechanism->installation,
                    'testing' => $project->mechanism->testing,
                    'monitoring' => $project->mechanism->monitoring
                ],
                'content' => $project->content,
                'waypoints' => $this->splitArray($project->waypoints),
                'launched' => $project->launched,
                'proponent' => $project->proponent,
                'problems' => $project->problems,
                'solution' => $project->solution,
                'completion' => $project->completion,
                'impact' => $this->splitArray($project->impact),
                'output' => $project->output,
                'costing' => $project->costing,
                'future' => $project->future
            ];
        }
        $data=[
            "status"=>200,
            "message"=>'Data Retrieved Successfully'
        ];

        return response()->json($data, 200);
    }

    function concatenateArray(array $strings, $separator = '|') {
        return implode($separator, $strings);
    }

    public function upload(Request $request){
        
        dd($request->all());
        $validator= Validator::make($request->all(),
        [
            'title'=>'required',
            'logo'=>'required', 
            'description'=>'required', 
            'abstract'=>'required',
            'overview'=>'required',
            'image'=>'required',
            'tag_name' => 'required',
            'tag_image' =>'required',
            'objectives'=>'required',
            'subject_initiator' => 'required',
            'subject_leader' => 'required',
            'subject_members' => 'required',
            'environment_nature' => 'required',
            'environment_industry' => 'required',
            'environment_government' => 'required',
            'resources_human' => 'required',
            'resources_financial' => 'required',
            'resources_technical' => 'required',
            'mechanism_planning' => 'required',
            'mechanism_design' => 'required',
            'mechanism_installation' => 'required',
            'mechanism_testing' => 'required',
            'mechanism_monitoring' => 'required',
            'content'=>'required', 
            'waypoint'=>'required', 
            'launched'=>'required',
            'proponent'=>'required',
            'progress'=>'required',
            'problems'=>'required',
            'solutions'=>'required',
            'completion'=>'required',
            'impact'=>'required', 
            'output'=>'required',
            'costing'=>'required',
            'future'=>'required'    
        ], [
            'title.required' => 'Title is required',
            'logo.required' => 'Logo is required',
            'description.required' => 'Description is required',
            'abstract.required' => 'Abstract is required',
            'overview.required' => 'Overview is required',
            'image.required' => 'Image is required',
            'tag_name.required' => 'Tag Name is required',
            'tag_image.required' => 'Tag Image Id is required',
            'objectives.required' => 'Objectives is required',
            'subject_initiator.required' => 'Subject Initiator is required',
            'subject_leader.required' => 'Subject Leader is required',
            'subject_members.required' => 'Subject Members is required',
            'environment_nature.required' => 'Environment Nature is required',
            'environment_industry.required' => 'Environment Industry is required',
            'environment_government.required' => 'Environment Government is required',
            'resources_human.required' => 'Resources Human is required',
            'resources_financial.required' => 'Resources Financial is required',
            'resources_technical.required' => 'Resources Technical is required',
            'mechanism_planning.required' => 'Mechanism Planning is required',
            'mechanism_design.required' => 'Mechanism Design is required',
            'mechanism_installation.required' => 'Mechanism Installation is required',
            'mechanism_testing.required' => 'Mechanism Testing is required',
            'mechanism_monitoring.required' => 'Mechanism Monitoring is required',
            'content.required' => 'Content is required',
            'waypoint.required' => 'Waypoint is required',
            'launched.required' => 'Launched is required',
            'proponent.required' => 'Proponent is required',
            'progress.required' => 'Progress is required',
            'problems.required' => 'Problems is required',
            'solutions.required' => 'Solutions is required',
            'completion.required' => 'Completion is required',
            'impact.required' => 'Impact is required',
            'output.required' => 'Output is required',
            'costing.required' => 'Costing is required',
            'future.required' => 'Future is required',
        ]);
        
        if($validator->fails()){
            $message = $validator->messages()->all()[0];
            $data=[
                "status"=>422,
                "message"=>$validator->$message
            ];
            return response()->json($data, 422);

        }else{
            
            $tags_form = [
                'name' => $this->concatenateArray($request->tag_name),
                'image' => $this->concatenateArray($request->tag_image)
            ];
            $tag = Tag::create($tags_form);

            $subject_form = [
                'initiator' => $request->subject_initiator,
                'leader' => $request->subject_leader,
                'members' => $this->concatenateArray($request->subject_members)
            ];
            $subject = Subject::create($subject_form);

            $environment_form = [
                'nature' => $request->environment_nature,
                'industry' => $request->environment_industry,
                'government' => $request->environment_government
            ];
            $environment = Environment::create($environment_form);

            $resources_form = [
                'human' => $this->concatenateArray($request->resources_human),
                'financial' => $this->concatenateArray($request->resources_financial),
                'technical' => $this->concatenateArray($request->resources_technical)
            ];
            $resources = Resource::create($resources_form);

            $mechanism_form = [
                'planning' => $request->mechanism_planning,
                'design' => $request->mechanism_design,
                'installation' => $request->mechanism_installation,
                'testing' => $request->mechanism_testing,
                'monitoring' => $request->mechanism_monitoring
            ];
            $mechanism = Mechanism::create($mechanism_form);

            $projects =  new Project;
            $projects->tags_id=$tag->id;
            $projects->subject_id=$subject->id;
            $projects->environment_id=$environment->id;
            $projects->resources_id=$resources->id;
            $projects->mechanism_id=$mechanism->id;
            $projects->title=$request->title;
            $projects->logo=$request->logo; 
            $projects->description=$request->description;
            $projects->abstract=$request->abstract;
            $projects->overview=$request->overview;
            $projects->image=$request->image;
            $projects->objectives=$this->concatenateArray($request->objectives);
            $projects->content=$request->content;
            $projects->waypoints=$this->concatenateArray($request->waypoint);
            $projects->launched=$request->launched;
            $projects->proponent=$request->proponent;
            $projects->progress=$request->progress;
            $projects->problems=$request->problems;
            $projects->solutions=$request->solutions;
            $projects->completion=$request->completion;
            $projects->impact=$this->concatenateArray($request->impact);
            $projects->output=$request->output;
            $projects->costing=$request->costing;
            $projects->future=$request->future;
            $projects->save();

            $data=[
                "status"=>200,
                "message"=>'Data Uploaded Successfully'
            ];

            return response()->json($data, 200);

        }
    }
    public function edit(Request $request, $id){
        $validator= Validator::make($request->all(),
        [

            'id'=>'required',
            'tags_id'=>'required',
            'subject_id'=>'required',
            'environment_id'=>'required',
            'resources_id'=>'required',
            'mechanism_id'=>'required',
            'title'=>'required',
            'logo'=>'required', 
            'abstract'=>'required',
            'overview'=>'required',
            'image'=>'required',
            'launchd'=>'required',
            'proponent'=>'required',
            'progress'=>'required',
            'problems'=>'required',
            'solution'=>'required',
            'completion'=>'required',
            'output'=>'required',
            'costing'=>'required',
            'future'=>'required'
            
        ]);
        
        if($validator->fails())
        {

            $data=[
                "status"=>422,
                "message"=>$validator->messages()
            ];
            
            return response()->json($data, 422);
          

        }else{
            $projects =  Project::find($id);

            $projects->id=$request->id;
            $projects->tags_id=$request->tags_id;
            $projects->subject_id=$request->subject_id;
            $projects->environment_id=$request->environment_id;
            $projects->resources_id=$request->resources_id;
            $projects->mechanism_id=$request->mechanism_id;
            $projects->title=$request->title;
            $projects->logo=$request->logo; 
            $projects->abstract=$request->abstract;
            $projects->overview=$request->overview;
            $projects->image=$request->image;
            $projects->launchd=$request->launchd;
            $projects->proponent=$request->proponent;
            $projects->progress=$request->progress;
            $projects->problems=$request->problems;
            $projects->solution=$request->solution;
            $projects->completion=$request->completion;
            $projects->output=$request->output;
            $projects->costing=$request->costing;
            $projects->future=$request->future;

            $projects->save();

            $data=[
                "status"=>200,
                "message"=>'Data Updated'
            ];

            return response()->json($data, 200);

        }
    }
    public function delete($id){
        $projects =  Project::find($id);
        $projects->delete();
        $data=[
            "status"=>200,
            "message"=>'Data Deleted'
        ];

        return response()->json($data, 200);
    }
}
