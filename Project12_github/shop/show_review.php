<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>レビューを書く</title>
    <link rel="stylesheet" href="css/stylesheet.css">
</head>
<body>
    <div class="review-wrapper">
        <h1>レビューを書く</h1>
        <form method="post" class="order-wrapper">
            <p>商品について</p>
            <label for="review_content">レビュー内容:</label><br>
            <textarea id="review_content" name="review_content" required style="width: 90%; height: 100px; margin-top: 10px;"></textarea><br>
            <label for="star">評価（1〜5）:</label><br>
            <select id="star" name="star" required style="margin-top: 10px;">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <!-- 1回目のechoはvalueは送信される値    -->
                     <!-- 2回目のechoは、$iの値を表示 -->
                <?php endfor; ?>
            </select><br><br>
            <button type="submit" style="margin-top: 10px; padding: 10px 20px; background-color: #357abd; color: white; border: none; border-radius: 5px;">送信</button>
        </form>
        <br>
        <a href="show.php" style="display: block; margin-top: 20px; color: #4a90e2;">元に戻る</a>
        <a href="index.php" style="display: block; margin-top: 10px; color: #4a90e2;">商品購入ページに戻る</a>
    </div>
</body>
</html>