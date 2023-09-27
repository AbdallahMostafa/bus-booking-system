#!/bin/bash

# API endpoint URL
URL="http://localhost:9000/api/book"

# Authorization token
TOKEN="1|ucQTUbCgnJhwBRu1rLZe1FnCkZYH93Qhag3pTvFr3c617cc5"

# JSON body
JSON='{
    "departure_location_id": "Alminya",
    "arrival_location_id": "Asyut",
    "seat_id": 9
}'

# Define a function to send a request
send_request() {
    local url="$1"
    local data='{
    "departure_location_id": "Alminya",
    "arrival_location_id": "Asyut",
    "seat_id": 9
}'
    curl -X POST -H "Authorization: Bearer ucQTUbCgnJhwBRu1rLZe1FnCkZYH93Qhag3pTvFr3c617cc5" -H "Content-Type: application/json" -d "$data" "$url"
}

# Use parallel to send two requests simultaneously
export -f send_request
parallel -j2 send_request ::: "$URL" "$URL" ::: "$JSON" "$JSON"
