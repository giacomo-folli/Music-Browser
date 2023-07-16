<div class="class_61" style="display:center;">
    <div class="class_62" style="display:center;">
        <a href="index.php" class="class_63"  >
    		Home
    	</a>
    </div>
	<div class="class_62" style="display:center;">
		<?php if(is_logged_in()): ?>
			<a href="profile.php" class="class_63"  >
				Profile
			</a>
		<?php endif; ?>
	</div>
	<div class="class_62" style="display:center;">
        <a href="info.php" class="class_63"  >
    		About Us
    	</a>
    </div>
	<div class="class_62" style="text-align:center;">
		<?php if(is_logged_in()): ?>
			<a href="settings.php" class="class_63"  >
				Settings
			</a>
		<?php endif; ?>
	</div>
</div>

</body>
</html>