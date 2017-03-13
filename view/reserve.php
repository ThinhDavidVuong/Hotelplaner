<div>
    <h3 name="hotelname" class="center"> <?= $hotel->name; ?> </h3>
    <p name="stars" class="center"> <?php for ($x = 0; $x < $hotel->stars; $x++) : ?>&#9733<?php endfor; ?> </p><br>
</div>

<div>
    <div class="left">
        <h4 class="list-group-item list-group-item-info">Art der unterbingung</h4><br>
        <select>
            <option>--</option>
            <option value="einzelzimmer">Einzelzimmer</option>
            <option value="doppelzimmer">Doppelzimmer</option>
            <option value="doppelzimmer">Viererzimmer</option>
        </select>
    </div>

    <div class="left">
        <h4 class="list-group-item list-group-item-info">Personen</h4><br>
        <select>
            <option>--</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="3">4</option>
        </select>
    </div>

    <div class="left">
        <h4 class="list-group-item list-group-item-info">Optionen</h4><br>
        <div class="checkbox">
            <label><input type="checkbox" value="">Frühstück</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" value="">Mittag</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" value="">Nachmittag</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" value="">Abends</label>
        </div>
    </div>

    <div class="left">
        <h4 class="list-group-item list-group-item-info">Anzahl Tage</h4><br>

        <h4>Start Date </h4>
        <label>Month</label>
        <select/>
            <option>January</option>
            <option>February</option>
            <option>March</option>
            <option>April</option>
            <option>May</option>
            <option>June</option>
            <option>July</option>
            <option>August</option>
            <option>September</option>
            <option>October</option>
            <option>November</option>
            <option>December</option>
        </select> -

        <label>Day</label>
        <select/>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
            <option>21</option>
            <option>22</option>
            <option>23</option>
            <option>24</option>
            <option>25</option>
            <option>26</option>
            <option>27</option>
            <option>28</option>
            <option>29</option>
            <option>30</option>
            <option>31</option>
        </select> -

        <label>Year</label>
        <select/>
        <option>2017</option>
        <option>2018</option>
        <option>2019</option>
        <option>2020</option>
        <option>2021</option>
        </select>
        <span class="inst">(Month-Day-Year)</span><br>
        </fieldset>

        <h4>End Date </h4>
        <label>Month</label>
        <select/>
            <option>January</option>
            <option>February</option>
            <option>March</option>
            <option>April</option>
            <option>May</option>
            <option>June</option>
            <option>July</option>
            <option>August</option>
            <option>September</option>
            <option>October</option>
            <option>November</option>
            <option>December</option>
        </select> -

        <label>Day</label>
        <select/>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
            <option>21</option>
            <option>22</option>
            <option>23</option>
            <option>24</option>
            <option>25</option>
            <option>26</option>
            <option>27</option>
            <option>28</option>
            <option>29</option>
            <option>30</option>
            <option>31</option>
        </select> -

        <label>Year</label>
        <select/>
            <option>2017</option>
            <option>2018</option>
            <option>2019</option>
            <option>2020</option>
            <option>2021</option>
        </select>
        <span class="inst">(Month-Day-Year)</span>
    </div>
</div>

<div class="left">
    <h4 class="list-group-item list-group-item-success">Buchung bestätigen</h4><br>
    <h5>Preis: </h5>
    <button type="button" class="btn btn-primary">Buchen</button>
</div>
