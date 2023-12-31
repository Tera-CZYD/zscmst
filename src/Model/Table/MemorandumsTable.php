<?php 

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Query;
use Cake\Database\StatementInterface;

class MemorandumsTable extends Table{

  public function initialize(array $config): void{

    $this->addBehavior('Timestamp');

    $this->hasMany('MemorandumImages', [

      'foreignKey' => 'memorandum_id', 

    ]);

  }

  public function getAllMemorandumPrint($conditions){

    $search = @$conditions['search'];

    $sql = "

      SELECT

        Memorandum.*

      FROM

        memorandums as Memorandum 

      WHERE

        Memorandum.visible = true AND

        (
 
          Memorandum.title           LIKE  '%$search%'

        )

    ";

    $query = $this->getConnection()->prepare($sql);

    $query->execute();

    return $query;

  }

  public function getAllMemorandum($conditions, $limit, $page){

    $search = @$conditions['search'];

    $offset = ($page - 1) * $limit;

    $sql = "

      SELECT

        Memorandum.*

      FROM

        memorandums as Memorandum 

      WHERE

        Memorandum.visible = true AND

        (
 
          Memorandum.title           LIKE  '%$search%' 

        )

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

    $result = $this->getAllMemorandum($conditions, $limit, $page)->fetchAll('assoc');

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

    $sql = "

      SELECT

        count(*) as count

       FROM

        memorandums as Memorandum 

      WHERE

        Memorandum.visible = true AND

        (
 
          Memorandum.title           LIKE  '%$search%'

        )

    ";

    $query = $this->getConnection()->execute($sql)->fetch('assoc');

    return $query['count'];

  }

}
