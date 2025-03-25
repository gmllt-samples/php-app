PORT ?= 8080

run:
	@echo "Starting PHP server on port $(PORT)..."
	@php -S localhost:$(PORT) -t public

.PHONY: run
