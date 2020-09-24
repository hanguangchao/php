print("hello world")


local a = true
local b = 0
local c = nil

if a then
    print("a")
else
    print("not a")
end

if b then
    print("b")
else
    print("not b ")
end

if c then
    print("c")
else
    print("not c")
end


local order = 3.99
local score = 98.01

print(math.floor(order))
print(math.ceil(score))

local corp = {
    web = "www.google.com",
    telephone = 12332222,
    staff = {"Jack", "Scott", "Gary"},
    100876,
    100191,
    ["10"] = 100,
    [10] = 22200,
    ['10'] = 33300,
    ["city"] = "Beijing",
}

print(corp[1])
print(corp[2])
print(corp[10])
print(corp["10"])
print(corp['10'])
print(corp.city)
print(corp["city"])
print(corp["staff"][1])


print("hello" .. "world")


local a = {"a", "b", "c", "d"}
for i , v in ipairs(a) do 
    print("index :", i, "value:", v)
end




local days = {
   "Monday", "Tuesday", "Wednesday", "Thursday",
   "Friday", "Saturday","Sunday"
}

local revDays = {}
for k, v in pairs(days) do
    revDays[v] = k
end

for k, v in pairs(revDays) do 
    print(k, v)
end




function newCounter()
    local i = 0
    return function()     -- anonymous function
       i = i + 1
        return i
    end
end
 
c1 = newCounter()
print(c1())  --> 1
print(c1())  --> 2







print(string.byte("abc", 1, 3))
print(string.char(97, 98, 99))
print(string.upper("Hello Lua"))
print(string.lower("Hello Lua"))
print(string.len("Hello Lua"))
print(string.len("中文"))



local find = string.find


print(find("abc cba", "ab"))
print(find("abc cba", "ab", 1))
print(find("abc cba", "ab", 2))
print(find("abc cba", "ab", -1))
print(find("abc cba", "ab", -8))
print(find("abc cba", "%a+", 1))

start, _end = find("abc cba", "%a+", 1)
print(start, _end)


print(string.format("%.4f", 3.1415926))
print(string.format("%d %x %o", 31, 31, 31))


print(string.match("hello lua", "lua"))
print(string.match("lua lua", "lua"))


s = "hello world from Lua"
for w in string.gmatch(s, "%a+") do 
    print(w)
end 

print("======")

t = {}
s = "from=world, to=Lua"
for k , v in string.gmatch(s, "(%a+)=(%a+)") do
    t[k] = v
end

for k, v in pairs(t) do
    print(k, v)
end


print(string.rep("abc", 3))

print(string.sub("Hello Lua", 4, 7))
print(string.sub("Hello Lua", -3, -1))

print(string.gsub("Lua Lua Lua", "Lua", "hello"))
print(string.gsub("Lua Lua Lua", "Lua", "hello", 2))

print(string.reverse("Hello Lua"))



-- table 下标从1开始

s = {1, 2, 3, 4}
s[4] = nil
print(#s)
for i, v in pairs(s) do
    print(i, v)
end



local a = {1, 3, 5, "hello"}

print(table.concat(a))
print(table.concat(a, "|"))
table.insert(a, 1, 3)

print(table.concat(a, "|"))

-- local a = {1, 2, 3}
-- print(table.maxn(a))

print("=======")
print(table.remove(a, 1))
print(a[1], a[2])
print("=======")

print(os.time())


local day  = {year=2018, month=7, day=30}
print(os.time(day))

print(os.date("%Y-%m-%d %H:%M:%S"))


-- io

-- file = io.input('1.txt')
-- repeat
--     line = io.read()
--     if nil == line then
--         break
--     end
--     print(line)
--  until (false)
-- io.close(file)


-- file = io.open('1.txt', 'a+')
-- io.output(file)
-- io.write("\nhello world")
-- io.close(file)

-- print("=======")
-- local start_time = os.time()
-- file = io.open("1.txt", "r")
-- for line in file:lines() do 
--     -- print(line)
-- end
-- file:close()
-- local end_time = os.time()
-- print(string.format("cost %.4f seconds.", end_time - start_time))




function allwords()

    local line = io.read()
    local pos = 1
    return function()
        while line do
            local w, e = string.match(line, "(%w+)()", pos)
            if w then
                pos = e 
                return w
            else
                line = io.read()
                pos = 1
            end
        end
        return nil
    end
end

file = io.input("./words.txt")
for word in allwords() do
    print(word)
end
io.close(file)




-- Traversing Tables in Order

function parisByKeys(t, f)
    -- 将键收集到数组a
    -- 数组a排序
    local a = {}
    for n in pairs(t) do
        a[#a+1] = n
    end
    table.sort(a, f)
    -- 返回迭代器函数
    local i = 0
    return function ()
        i = i + 1
        return a[i], t[a[i]]
    end
end

lines = {
    ["luaH_set"] = 10,
    ["luaH_get"] = 24,
    ["luaH_present"] = 48,
}

for name, line in parisByKeys(lines) do 
    print(name, line, "\n")
end



function allwords (f)
    for line in io.lines() do
        for word in string.gmatch(line, "%w+") do
            f(word)
        end
    end
end

io.input('./words.txt')
allwords(print)
io.close()
print('=======')


io.input('./words.txt')
local count = 0
allwords(function (w)
    if w == "hello" then count = count + 1 end
end)
print(count)
io.close()








-- metatable 元表
-- setmetatable(table, metatable)
-- getmetatable(table)

print("====metatable====")
local a = {1, 2}
local b = {11, 22}


t = {}
print(getmetatable(t))

t1  = {}
setmetatable(t, t1)
print(getmetatable(t))



--- 数组元素要删除，使用 remove , 不要用nil去代替


