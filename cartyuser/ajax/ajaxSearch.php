

<?php
if (isset($_POST['searchTest'])) {
		$response = "<ul class='ulAjaxNo'><li class='liAjaxNo'>No data found!</li></ul>";

		include_once "../products.php";
		$search = new products();
		$search->setSearch($_POST['key']);
		$res = $search->searchAjax();
		
		if ($res->num_rows > 0) {
			$response = "<ul class='ulAjax'>";
			while($row = mysqli_fetch_assoc($res))
				$response .= "<li class='liAjax'>" . $row['name'] . "</li>";

			$response .= "</ul>";
		}


		exit($response);
    }
    
    
?>