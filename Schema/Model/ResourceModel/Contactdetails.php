<?php
namespace Perspective\Schema\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Contactdetails extends AbstractDb{
    public function _construct()
    {
        $this->_init("declarative_table", 'entity_id');
    }
}
?>