# Kyle

**Monitor when to bill clients based on their services employed.**

The main point of interest here are "events".

Services have:

- title
- note
- month ( 1-12 ) - which month this expense happens
- day ( 1-31 ) - which day this expense happens
- cost
- currency (HRK, USD, EUR)
- client_id
- active

ServiceLog have:

- service_id
- occurs_at (exact date of the event)
- offer_sent
- payment_received
- receipt_sent

Clients have:

- name
- oib
- street
- city
- postal code

> At the start of every year, create new service occurances.