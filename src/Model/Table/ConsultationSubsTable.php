<?php 

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Query;
use Cake\Database\StatementInterface;

class ConsultationSubsTable extends Table{

  public function initialize(array $config): void{

    $this->addBehavior('Timestamp');


  }

}
