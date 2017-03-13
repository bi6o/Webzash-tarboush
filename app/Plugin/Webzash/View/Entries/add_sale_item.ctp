<?php
// Generate a random id to use in below form array
$i = time() + rand  (0, time()) + rand  (0, time()) + rand  (0, time());

echo '<tr class="ajax-add">';

echo '<td>';
echo $this->Form->input('material_name', array('name' => 'data[Sale]['.$i.'][material_name]' ,'class'=> 'form-control material_name','type' => 'text', 'label' => __d('webzash', ' ')));
echo '</td>';

echo '<td>';
echo $this->Form->input('material_type', array('name' => 'data[Sale]['.$i.'][material_type]' ,'class'=> 'form-control material_type','type' => 'text', 'label' => __d('webzash', ' ')));
echo '</td>';

echo '<td>';
echo $this->Form->input('quantity', array('name' => 'data[Sale]['.$i.'][quantity]' ,'class'=> 'form-control quantity','type' => 'float', 'label' => __d('webzash', ' ')));
echo '</td>';

echo '<td>';
echo $this->Form->input('price', array('name' => 'data[Sale]['.$i.'][price]' ,'class'=> 'form-control price','type' => 'number', 'label' => __d('webzash', ' ')));
echo '</td>';

echo '<td>';
echo $this->Form->input('unit', array('name' => 'data[Sale]['. $i .'][unit]' ,'class'=> 'form-control unit', 'type' => 'text', 'label' => __d('webzash', ' ')));
echo '</td>';

echo '<td>';
echo $this->Html->tag('span', $this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-trash')) . __d('webzash', ' Delete'), array('class' => 'deleteSaleRow', 'escape' => false));
echo '</td>';

echo '</tr>';
?>
