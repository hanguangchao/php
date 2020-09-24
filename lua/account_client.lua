-- account_client.lua


local account = require("account")

local a = account:new(1000)
print(a.balance)
a:deposit(100)
print(a.balance)
