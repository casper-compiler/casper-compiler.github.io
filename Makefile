deploy:
	rsync -r . --exclude .git /var/www/casper
.PHONY: deploy