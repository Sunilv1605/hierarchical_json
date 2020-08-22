<?php
class Services{
  /**
   * We want you to write PHP code that converts this flattened JSON into a hierarchical JSON
   *
   * @param array  $records      array of records to apply the nesting
   * @param string $nodePrimaryKey property to read the current record_id, e.g. 'id'
   * @param string $nodeForeignKey property to read the related parent_id, e.g. 'parent'
   * @param string $childWrapper name of the property to place children, e.g. 'child'
   * @param string $parentId     optional filter to filter by parent, e.g. 0
   *
   * @return array
   */
  public static function nest(&$records, $nodePrimaryKey = 'id', $nodeForeignKey = 'parent', $childWrapper = 'child', $parentId = 0)
  {
  	$nestedRecords = [];
  	foreach ($records as $index => $children) {
  		if (isset($children[$nodeForeignKey]) && $children[$nodeForeignKey] == $parentId) {
  			unset($records[$index]);
  			$children[$childWrapper] = self::nest($records, $nodePrimaryKey, $nodeForeignKey, $childWrapper, $children[$nodePrimaryKey]);
  			$nestedRecords[] = $children;
  		}
  	}
  	return $nestedRecords;
  }
}
?>