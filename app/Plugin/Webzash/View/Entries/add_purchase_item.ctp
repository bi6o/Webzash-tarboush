<?php
// Generate a random id to use in below form array
$i = time() + rand  (0, time()) + rand  (0, time()) + rand  (0, time());

echo '<tr class="ajax-add">';

echo '<td>';
echo $this->Form->input('material_name', array('name' => 'data[Purchase]['.$i.'][material_name]' ,'class'=> 'form-control material_name','type' => 'text', 'label' => __d('webzash', ' ')));
echo '</td>';

echo '<td>';
echo $this->Form->input('material_type', array('name' => 'data[Purchase]['.$i.'][material_type]' ,'class'=> 'form-control material_type','type' => 'text', 'label' => __d('webzash', ' ')));
echo '</td>';

echo '<td>';
echo $this->Form->input('quantity', array('name' => 'data[Purchase]['.$i.'][quantity]' ,'class'=> 'form-control quantity','type' => 'number', 'label' => __d('webzash', ' ')));
echo '</td>';

echo '<td>';
echo $this->Form->input('price', array('name' => 'data[Purchase]['.$i.'][price]' ,'class'=> 'form-control price','type' => 'float', 'label' => __d('webzash', ' ')));
echo '</td>';

echo '<td>';
echo $this->Form->input('unit', array('name' => 'data[Purchase]['. $i .'][unit]' ,'class'=> 'form-control unit', 'type' => 'text', 'label' => __d('webzash', ' ')));
echo '</td>';

echo '<td>';
echo $this->Form->input('is_cash', array('name' => 'data[Purchase]['.$i.'][is_cash]' ,'class'=> 'form-control is_cash','type' => 'checkbox', 'label' => __d('webzash', ' ') , 'class' => 'col-xs-0'));
echo '</td>';

echo '<td>';
echo $this->Html->tag('span', $this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-trash')) . __d('webzash', ' Delete'), array('class' => 'deletePurchaseRow', 'escape' => false));
echo '</td>';

echo '</tr>';
?>
