<?php
// ============================================================
// views/templates/footer.php — ...
// ============================================================
?>
        </main>
        <footer>
            <a href="#">Conditions générales de vente</a>
            <a href="#">Cookies</a>
            <a href="#">Contact</a>
            <?php if (isset($_SESSION['administrateur_id'])): ?>
                <a href="index.php?page=dashboard">Dashboard admin</a>
            <?php else: ?>
                <a href="index.php?page=login">Espace admin</a>
            <?php endif; ?>
            <p>© 2026, Inkado</p>
        </footer>
    </body>
</html>
