<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;



class ParticipantEvaluationActivitiesTable extends Table
{
   public function initialize(array $config): void{

    $this->addBehavior('Timestamp');

    $this->belongsTo('CollegePrograms', [

      'foreignKey' => 'course_id',

      'propertyName' => 'CollegeProgram'

    ]);

    $this->belongsTo('YearLevelTerms', [

      'foreignKey' => 'year_term_id', 

      'propertyName' => 'YearLevelTerm'

    ]);;

  }

  public function getAllParticipantEvaluationActivityPrint($conditions){

    $search = @$conditions['search'];

    $date = @$conditions['date'];

    $studentId = @$conditions['studentId'];

    $sql = "

      SELECT 

      ParticipantEvaluationActivity.*,

      CollegeProgram.name as program_name,

      YearLevelTerm.description

    FROM 

      participant_evaluation_activities as ParticipantEvaluationActivity LEFT JOIN 

      college_programs as CollegeProgram ON ParticipantEvaluationActivity.course_id = CollegeProgram.id LEFT JOIN

      year_level_terms as YearLevelTerm ON ParticipantEvaluationActivity.year_term_id = YearLevelTerm.id

    WHERE 

      ParticipantEvaluationActivity.visible = true $search $date $studentId AND 

      (

        ParticipantEvaluationActivity.activity        LIKE      '%$search%'     OR

        ParticipantEvaluationActivity.date            LIKE      '%$search%'     OR

        ParticipantEvaluationActivity.venue           LIKE      '%$search%'     OR

        ParticipantEvaluationActivity.course_id       LIKE      '%$search%'     

      )

      ORDER BY 

        ParticipantEvaluationActivity.id ASC

    ";

    $query = $this->getConnection()->prepare($sql);

    $query->execute();

    return $query;

  }

  public function getAllParticipantEvaluationActivity($conditions, $limit, $page){

    $search = @$conditions['search'];

    $date = @$conditions['date'];

    $studentId = @$conditions['studentId'];

    $offset = ($page - 1) * $limit;

    $sql = "

      SELECT 

      ParticipantEvaluationActivity.*,

      CollegeProgram.name as program_name,

      YearLevelTerm.description

    FROM 

      participant_evaluation_activities as ParticipantEvaluationActivity LEFT JOIN 

      college_programs as CollegeProgram ON ParticipantEvaluationActivity.course_id = CollegeProgram.id LEFT JOIN

      year_level_terms as YearLevelTerm ON ParticipantEvaluationActivity.year_term_id = YearLevelTerm.id

    WHERE 

      ParticipantEvaluationActivity.visible = true $studentId $search AND 

      (

        ParticipantEvaluationActivity.activity        LIKE      '%$search%'     OR

        ParticipantEvaluationActivity.date            LIKE      '%$search%'     OR

        ParticipantEvaluationActivity.venue           LIKE      '%$search%'     OR

        ParticipantEvaluationActivity.course_id       LIKE      '%$search%'    

      )

      GROUP BY

        ParticipantEvaluationActivity.id

      ORDER BY 

        ParticipantEvaluationActivity.id ASC

      LIMIT

        $limit OFFSET $offset

    ";

    $query = $this->getConnection()->prepare($sql);

    $query->execute();

    return $query;

  }

  public function paginate($query, array $options = []){

    $extra = isset($options['extra']) ? $options['extra'] : [];

    $conditions = isset($extra['conditions']) ? $extra['conditions'] : [];

    $page = $options['page'];

    $limit = $options['limit'];

    $result = $this->getAllParticipantEvaluationActivity($conditions, $limit, $page)->fetchAll('assoc');

    $paginator = [

      'page' => $page,

      'limit' => $limit,

      'count' => $this->paginateCount($conditions),

      'perPage' => $limit,

      'pageCount' => ceil($this->paginateCount($conditions) / $limit),

    ];

    return [

      'data' => $result,

      'pagination' => $paginator,

    ];

  }

  public function paginateCount($conditions = null){ 

    $search = @$conditions['search'];

    $date = @$conditions['date'];

    $studentId = @$conditions['studentId'];

    $sql = "

      SELECT

        count(*) as count

      FROM 

      participant_evaluation_activities as ParticipantEvaluationActivity LEFT JOIN 

      college_programs as CollegeProgram ON ParticipantEvaluationActivity.course_id = CollegeProgram.id LEFT JOIN

      year_level_terms as YearLevelTerm ON ParticipantEvaluationActivity.year_term_id = YearLevelTerm.id

    WHERE 

      ParticipantEvaluationActivity.visible = true $search $date $studentId AND 

      (

        ParticipantEvaluationActivity.activity        LIKE      '%$search%'     OR

        ParticipantEvaluationActivity.date            LIKE      '%$search%'     OR

        ParticipantEvaluationActivity.venue           LIKE      '%$search%'     OR

        ParticipantEvaluationActivity.course_id       LIKE      '%$search%'        

      )

    ";

    $query = $this->getConnection()->execute($sql)->fetch('assoc');

    return $query['count'];

  }



}
