<?php 
namespace App\Models;

use CodeIgniter\Model;

class EntityModel extends Model
{
    protected $table = 'entities'; // Corrected table name
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'desc', 'entity_type_id'];

    /**
     * Optional: Define table relationships using JOIN
     */
    public function getEntitiesWithTypes()
    {
        return $this->select('entities.*, entity_type.name as type_name')
                    ->join('entity_type', 'entity_type.id = entities.entity_type_id')
                    ->findAll();
    }


    
}
