## Command Bus

```
=> Command
    => Comand Bus [contains:middlewares]
        => Command Handler (one-to-one[Command:Handler])
            => No result is returned
```

- What type of thing is a command
- What is the nature of a command
- What are good names of a command
- Where in the appication are commands usully being generated
- Where does data usually come from
- What kind of data is used to construct a command
- Why do we use a Command Bus
- What is command bus middleware
- Why do we use commands
- What do commands have to do with hexagonal architecture
- How do you know a command was succesfully handled
- Why is a command bus not really helpful in a CRUD-based application
