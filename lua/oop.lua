-- oop.lua
-- 


Account = {balance = 0}

function Account.withdrow(self, v)
    self.balance = self.balance - v
end





a1 = Account;
a1.withdrow(a1, 100.00)
print(a1.balance)



a2 = {balance=0, withdrow  = Account.withdrow}
a2.withdrow(a2, 1000)
print(a2.balance)


function Account:withdrow(v)
    self.balance = self.balance - v
end
