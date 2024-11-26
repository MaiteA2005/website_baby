<?php
    foreach($products as $title => $productGroup) {
        $firstProduct = $productGroup[0];
        echo '<div class="article">';
        echo '<img  id="image-' . $title . '" src="./' . $firstProduct["image"] . '" alt="' . $firstProduct["title"] . '">';
        echo '<h2>' . $firstProduct["title"] . '</h2>';
        echo '<p>Prijs: €' . $firstProduct["price"] . '</p>';
        if (count($productGroup) > 1) {
            echo '</br><label for="color-' . $title . '">Kies een kleur: </br> </label>';
            echo '<select class="selector" name="color" id="color-' . $title . '" onchange="updateImage(\'' . $title . '\', this.value)">';
            foreach ($productGroup as $product) {
                echo '<option value="' . $product["color"] . '">' . $product["color"] . '</option>';
            }
            echo '</select>';
        }
        echo '</br><button>Add to favorites</button>';
        echo '</br><button>Add to cart</button>';
        echo '</br><a id="details-link-' . $title . '" href="details.php?id=' . urlencode($firstProduct["id"]) . '"><button>View Details</button></a>';
        echo '</div>';
    }
?>

<script>
    function updateImage(title, color) {
        var images = {
            <?php
                foreach ($products as $title => $productGroup) {
                    echo '"' . $title . '": [';
                    foreach ($productGroup as $product) {
                        echo '{color: "' . $product["color"] . '", image: "' . $product["image"] . '", id: "' . $product["id"] . '"},';
                    }
                    echo '],';
                }
            ?>
        };
        var productGroup = images[title];
        for (var i = 0; i < productGroup.length; i++) {
        if (productGroup[i].color === color) {
            document.getElementById('image-' + title).src = './' + productGroup[i].image;
            document.getElementById('details-link-' + title).href = 'details.php?id=' + productGroup[i].id;

            break;
        }
        }
    }
</script>