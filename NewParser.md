# FILE ORGANIZATION

### File stucture
```
header ::= (!(scenario_outline | scenario | background) .)*
```

```
language ::= language_key simple_space language_value white
language_key ::= '# language:'
language_value ::= (.\*)
```

```
feature ::= white comment tags header background? feature_elements comment?
```

### File stucture

```
steps ::= step*
step ::= comment step_keyword keyword_space line_to_eol (eol+ | eof) multiline_arg? white
```

// type of step
```
scenario ::= comment tags scenario_keyword space* lines_to_keyword white steps
scenario_outline ::= comment tags scenario_outline_keyword space* lines_to_keyword white steps examples_sections white
feature_elements ::= (scenario | scenario_outline)*
```

// type of step
```
background ::= comment background_keyword space* lines_to_keyword? (eol+ | eof) steps
```

// COMMENT RELATED
//////////////////

// Comment Python
```
py_string ::= open_py_string (!close_py_string .)* close_py_string
open_py_string :: = space* '"""' space* eol
close_py_string ::= eol space* '"""' white
```

// Comment
```
comment_line ::= space* '#' line_to_eol
comment ::= (comment_line white)*
```

// KEYWORD RELATED
////////////////

// Keyword
```
step_keyword ::= 'Given' | 'When' | 'Then' | 'And' | 'But'
scenario_outline_keyword ::= 'Scenario Outline:'
scenario_keyword ::= 'Scenario:'
background_keyword ::= 'Background:'
reserved_words_and_symbols ::= (step_keyword keyword_space) | scenario_keyword | scenario_outline_keyword | table | tag | comment_line
```

// Table
```
cell ::= [^\r\n|]+ '|'
row ::= space* '|' cell+ eol
table ::= row+
```

// Tag
```
tag ::= '@' ([^@\r\n\t ])+
tags ::= white (tag (space|eol)+)*
```

// Example
```
examples_sections ::= examples*
examples ::= comment space* examples_keyword space* lines_to_keyword? eol table white
examples_keyword ::= 'Examples:'
```

// SPACE RELATED
////////////////

// Line To
```
lines_to_keyword ::= (!(eol space* reserved_words_and_symbols) .)*
line_to_eol ::= (!eol .)*
multiline_arg ::=  table | py_string
```

// Space
```
space ::= ' ' | '\t'
eol ::= '\r'? '\n'
white ::= (space | eol)*
keyword_space ::= ' '
simple_space ::= ' '
```

```
eof = END OF FILE
```
