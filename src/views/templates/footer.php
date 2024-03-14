<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<?php if (!empty($additionalJs)) : ?>
    <?php foreach ($additionalJs as $jsFile) : ?>
        <script src="<?php echo $jsFile; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>

</html>