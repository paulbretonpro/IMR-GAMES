start:
	cd ./CLIENT/ && docker compose up -d
	cd ./API/ && ./vendor/bin/sail up -d
stop:
	cd ./CLIENT/ && docker compose down
	cd ./API/ && ./vendor/bin/sail down