local Set = {}
local mt = {}
function Set.new(l)
    local set = {}
    setmetatable(set, mt)
    for _, v in ipairs(l) do set[v] = true end
    return set 
end

function Set.union (a, b)
    local res = Set.new{}
    for k in pairs(a) do res[k] = true end
    for k in pairs(b) do res[k] = true end
    return res
end

function Set.tostring (set)
    local l = {}
    for e in pairs(set) do
        l[#l+1] = tostring(e)
    end
    return "{" .. table.concat(l, ", ") .. "}"
end


mt.__add = Set.union
local s1 = Set.new{1, 2, 3, 4, 5}
local s2 = Set.new{21, 22, 23, 1, 3,}

print(getmetatable(s1))

s3 = s1 + s2
print(Set.tostring(s3))




