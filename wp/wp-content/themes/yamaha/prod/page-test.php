
<?php $products[]  = get_field("specification_detail", 782); ?>
<?php $products[]  = get_field("specification_detail", 790); ?>
<?php $products[] = get_field("specification_detail", 762); ?>

<?php 

$compare = [];
foreach($products as $k => $product ){
    
    foreach($product as $t){
    if(isset($t['headline'])){
       
        
        foreach($t['specification'] as $s){
            
            $compare[$t['headline']][$s['title']][$k] = $s['description'];
        }
    }
    
}
}



 print_r(json_encode($compare));
 die;

?>

<pre>
<?php print_r($products[0]); ?>
<?php echo "./////////////////////////"; ?>
<?php print_r($products[1]); ?>

<?php print_r($products[2]); ?>
</pre>

