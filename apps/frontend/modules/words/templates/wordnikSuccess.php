<p>
<h2>DEFINITIONS:</h2>
<?php print_r($definitions) ?>
	<ul>
    <? foreach ($defsArray as $definition): ?>
    	<li>
			<?php echo $definition ?>
 		</li>
 	<? endforeach; ?>
	</ul>
	
	First Def: <?php echo $firstDef ?>

</p>

<p>
<h2>RELATED WORDS:</h2>
<?php print_r($related) ?>
<ul>
    <? foreach ($related[0]->wordstrings as $word): ?>
    	<li>
    		<strong><?php echo $word ?></strong>
 		</li>
 	<? endforeach; ?>
	</ul>
</p>

<p>
<h2>EXAMPLES:</h2>
<?php print_r($examples) ?>
	<ul>
    <? foreach ($examples as $example): ?>
    	<li>
    		<strong><?php echo $example->title ?></strong>
			<?php echo $example->display ?>
 		</li>
 	<? endforeach; ?>
	</ul>
</p>

<p>
<h2>WORD OF THE DAY:</h2>
<?php print_r($wotd) ?>
<ul>
	<li><?php echo $wotd->definition[0]->text ?></li>
	<li><?php echo $wotd->definition[1]->text ?></li>
</ul>
</p>

<p>
<h2>RANDOM WORD:</h2>
<?php print_r($random) ?>
<ul><li><?php echo $random->wordstring ?></li></ul>
</p>