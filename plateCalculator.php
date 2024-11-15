<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=1.0">
    <title>Project Calculator</title>
</head>
<body>
    <h1 class="header">Weight Plate Calculator PHP</h1>
    <form action="." method="post">
        <input type="hidden" name="action" value="process_data">

        <label>Enter Desired Weight: </label>
        <input type="number" step=".5" name="weight" value="<?php echo htmlspecialchars($weight ?? ''); ?>">
        <br>

        <input type="radio" id="pounds" name="metric" value="pounds" <?php echo ($metric === 'pounds') ? 'checked' : ''; ?>>
        <label for="pounds" class="checkbox">Pounds</label>

        <input type="radio" id="kilos" name="metric" value="kilos" <?php echo ($metric === 'kilos') ? 'checked' : ''; ?>>
        <label for="kilos" class="checkbox">Kilos</label>
        <br>

        <label>Bar Weight:</label>
        <input type="radio" id="45_pounds" name="bar_weight" value="45_pounds" class="bar" <?php echo ($barWeight == 45 || $barWeight == 20) ? 'checked' : ''; ?>>
        <label for="45_pounds">45lb/20kg</label>

        <input type="radio" id="35_pounds" name="bar_weight" value="35_pounds" class="bar"<?php echo ($barWeight == 35 || $barWeight == 16) ? 'checked' : ''; ?>>
        <label for="35_pounds">35lb/16kg</label>

        <input type="submit" value="submit" class="submit">
        
        <?php if (!empty($weightMessage) && !empty($altWeightMessage)): ?>
            <p><?php echo nl2br(htmlspecialchars($weightMessage)); ?></p>
            <p><?php echo nl2br(htmlspecialchars($altWeightMessage)); ?></p>
        <?php endif; ?>

        <h2>Weight to add per side: </h2>
        <h5>(May have to add .5 to 2 or .25 to 1)</h5>
        <?php if (!empty($platesNeeded)): ?>
            <ul>
                <?php foreach ($platesNeeded as $plateWeight => $count): ?>
                    <?php if ($count > 0): ?>
                        <li><?php echo "$count x $plateWeight " . htmlspecialchars($metric); ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </form>
</body>
</html>