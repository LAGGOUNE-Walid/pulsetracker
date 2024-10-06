#!/bin/bash
if [ -f /sys/kernel/mm/transparent_hugepage/enabled ]; then
    echo "Disabling Transparent Huge Pages (THP)"
    echo never > /sys/kernel/mm/transparent_hugepage/enabled
    echo never > /sys/kernel/mm/transparent_hugepage/defrag
else
    echo "THP settings file not found. Skipping THP disable step."
fi

# Start MariaDB
exec "$@"