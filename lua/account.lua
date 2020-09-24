-- account.lua

local _M = {}
local mt = {__index = _M}

function _M.deposit(self, v)
    self.balance = self.balance + v
end

function _M.withdraw(self, v)
    if self.balance > v then
        self.balance = self.balance - v
    else
        error("insufficient funds")
    end
end

function _M.new(self, balance)
    self.balance = balance or 0
    return setmetatable(_M, mt)
end
return _M
