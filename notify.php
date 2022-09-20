<?php
    if (!isset($dndtoy)) header('location:index.php');
    if ((!empty($_SESSION['verid'])) && (!empty($_SESSION['vertitle'])) && (!empty($_SESSION['vertype']))) {
?>
	<script>Swal.fire('<?php echo $_SESSION['vertitle'];?>', '<?php echo $_SESSION['verid'];?>','<?php echo $_SESSION['vertype'];?>');</script>
<?php
        $_SESSION['verid'] = "";
        $_SESSION['vertype'] = "";
        $_SESSION['vertitle'] = "";
    }
?>
