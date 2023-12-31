<?php 

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Query;
use Cake\Database\StatementInterface;

class CheckOutsTable extends Table{

  public function initialize(array $config): void{

    $this->addBehavior('Timestamp');

    $this->hasMany('CheckOutSubs', [

      'foreignKey' => 'check_out_id', 

    ]);

    $this->belongsTo('LearningResourceMembers', [

      'foreignKey' => 'learning_resource_member_id', 

    ]);

  }

  public function getAllCheckOutPrint($conditions){

    $search = @$conditions['search'];

    $date = @$conditions['date'];

    $borrower_id = @$conditions['borrower_id'];

    $sql = "

      SELECT 

        CheckOut.*

      FROM 

        check_outs as CheckOut 

      WHERE 

        CheckOut.visible = true $date AND 

        (

          CheckOut.library_id_number LIKE '%$search%' OR 

          CheckOut.member_name LIKE '%$search%' OR 

          CheckOut.email LIKE '%$search%'      

        )

      ORDER BY 

        CheckOut.id DESC

    ";

    $query = $this->getConnection()->prepare($sql);

    $query->execute();

    return $query;

  }

  public function getAllCheckOut($conditions, $limit, $page){

    $search = @$conditions['search'];

    $date = @$conditions['date'];

    $borrower_id = @$conditions['borrower_id'];

    $offset = ($page - 1) * $limit;

    $sql = "

      SELECT 

        CheckOut.*

      FROM 

        check_outs as CheckOut 

      WHERE 

        CheckOut.visible = true $date AND 

        (

          CheckOut.library_id_number LIKE '%$search%' OR 

          CheckOut.member_name LIKE '%$search%' OR 

          CheckOut.email LIKE '%$search%'      

        )

      ORDER BY 

        CheckOut.id DESC

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

    $result = $this->getAllCheckOut($conditions, $limit, $page)->fetchAll('assoc');

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

    $borrower_id = @$conditions['borrower_id'];

    $sql = "

      SELECT 

        count(*) as count

      FROM 

        check_outs as CheckOut 

      WHERE 

        CheckOut.visible = true $date AND 

        (

          CheckOut.library_id_number LIKE '%$search%' OR 

          CheckOut.member_name LIKE '%$search%' OR 

          CheckOut.email LIKE '%$search%'      

        )

    ";

    $query = $this->getConnection()->execute($sql)->fetch('assoc');

    return $query['count'];

  }

}
