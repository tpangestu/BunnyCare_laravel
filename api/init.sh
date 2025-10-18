#!/bin/bash

# Create required directories
mkdir -p /tmp/storage
mkdir -p /tmp/storage/app
mkdir -p /tmp/storage/app/public
mkdir -p /tmp/storage/framework
mkdir -p /tmp/storage/framework/cache
mkdir -p /tmp/storage/framework/sessions
mkdir -p /tmp/storage/framework/views
mkdir -p /tmp/storage/logs

mkdir -p /tmp/cache
mkdir -p /tmp/views
mkdir -p /tmp/framework

# Set permissions
chmod -R 755 /tmp/storage
chmod -R 755 /tmp/cache
chmod -R 755 /tmp/views
chmod -R 755 /tmp/framework

# Create .gitkeep files to preserve directories
touch /tmp/storage/.gitkeep
touch /tmp/storage/app/.gitkeep
touch /tmp/storage/app/public/.gitkeep
touch /tmp/storage/framework/.gitkeep
touch /tmp/storage/framework/cache/.gitkeep
touch /tmp/storage/framework/sessions/.gitkeep
touch /tmp/storage/framework/views/.gitkeep
touch /tmp/storage/logs/.gitkeep