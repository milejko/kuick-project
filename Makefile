######################
# Default parameters #
######################
IMAGE_NAME := kuickphp/project
.DEFAULT_GOAL := test
.PHONY: * # ignore files named like targets

######################
# Production targets #
######################
version.txt:
	git describe --always --tags > version.txt

test: version.txt
	# generate CI_TAG to avoid concurrent run collisions
	$(eval CI_TAG := $(IMAGE_NAME):$(shell date +%s%N))
	docker build --target=test-runner --tag $(CI_TAG) .
	docker run --rm -v ./:/var/www/html $(CI_TAG) sh -c "composer up && composer test:all"
	docker image rm $(CI_TAG)

build: version.txt
	docker build --no-cache --target=dist --platform "linux/amd64,linux/arm64" --tag=$(IMAGE_NAME):$(shell cat version.txt) .

#########################################
# Local development environment targets #
#########################################
start: version.txt
	docker build --target=dev-server --tag=$(IMAGE_NAME):$(shell cat version.txt) .
	docker run --rm --name kuick-project -v ./:/var/www/html $(IMAGE_NAME):$(shell cat version.txt) composer install
	docker run --rm --name kuick-project -v ./:/var/www/html -p 8080:80 \
		-e APP_ENV=dev \
		$(IMAGE_NAME):$(shell cat version.txt)
