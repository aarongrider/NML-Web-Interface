<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
?>
<!doctype html>
<html>
<head>
	<?php echo $this->html->charset();?>
	<title>Application &gt; <?php echo $this->title(); ?></title>
	<?php echo $this->html->style(array('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css', 'lithified')); ?>
	<?php echo $this->scripts(); ?>
	<?php echo $this->styles(); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
</head>
<body class="lithified">
	<div class="container-narrow">

		<div class="masthead">
			<ul class="nav nav-pills pull-right">
				<li>
					<a href="/simulation/generate">Generate Simulation</a>
				</li>
				<li>
					<a href="/simulation/log">Simulation Log</a>
				</li>
			</ul>
			<a href="/simulation/"><h3>NML&#10138;</h3></a><h4><a href="http://math.nist.gov/oommf/">OOMMF</a> Web Interface</h4>
		</div>

		<hr>

		<div class="content">
			<?php echo $this->content(); ?>
		</div>

		<hr>

		<div class="footer">
			<p>&copy; Department of Engineering and Computer Science | Seattle Pacific University | 2015</p>
		</div>

	</div>
</body>
</html>