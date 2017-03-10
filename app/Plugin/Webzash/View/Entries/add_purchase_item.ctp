<?php
// Generate a random id to use in below form array
$i = time() + rand  (0, time()) + rand  (0, time()) + rand  (0, time());

echo '<tr class="ajax-add">';

echo '<tr><td>';
echo $this->Form->input('material_type', array('name' => 'data[Purchase]['.$i.'][material_type]' ,'type' => 'text', 'label' => __d('webzash', 'Material type')));
echo $this->Form->input('quantity', array('name' => 'data[Purchase]['.$i.'][quantity]' ,'type' => 'number', 'label' => __d('webzash', 'Quantity')));
echo $this->Form->input('price', array('name' => 'data[Purchase]['.$i.'][price]' ,'type' => 'number', 'label' => __d('webzash', 'Price')));
echo $this->Form->input('is_cash', array('name' => 'data[Purchase]['.$i.'][is_cash]' ,'type' => 'checkbox', 'label' => __d('webzash', 'Cash') , 'class' => 'col-xs-0'));
echo '</tr></td>';
?>
